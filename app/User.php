<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\NewResetPassword;

class User extends Authenticatable
{
    use Notifiable;
		use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','nickname','provider','confirmation_token','simplyMarketting'
    ];
    protected $dates = [
        'created_at', 'updated_at', 'confirmed_at'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new NewResetPassword($token));
    }

    public static function generateToken() {
        return md5(microtime(true));
    }
    public function hasConfirmed() {
        return $this->confirmation_token === null ? true : false;
    }
    public function confirm($token) {
        // If the user has already confirmed we can't confirm him again.
        if ($this->hasConfirmed()) return false;

        if ($token === $this->confirmation_token) {
            // User has confirmed his e-mail address.
            $this->confirmation_token = null;
            $this->confirmed_at = \Carbon\Carbon::now();
            $this->save();

            return true;
        }

        // Token was incorrect.
        return false;
    }
    public function unconfirm() {
      // If the user is not even confirmed we can't unconfirm him.
      if (!$this->hasConfirmed()) return false;

      // Reset token with a newly generated one and save the model.
      $this->confirmation_token = User::generateToken();
      $this->confirmed_at = null;
      $this->save();

      return true;
  }
}
