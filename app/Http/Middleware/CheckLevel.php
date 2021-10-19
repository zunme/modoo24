<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLevel
{
    public function handle(Request $request, Closure $next, $role)
    {
        switch ($role) {
            case 'admin':
              /*
							session_start();
							$session =  $_SESSION;
							session_write_close();

							if (!isset($session['level']) || $session['level'] != '1' ) {
								return redirect('/');
							}
							break;
              */
              break;
            case 'user':
                if (auth()->user()->id < 1 ) {
                    return redirect('/');
                }
                break;
            default:
                return redirect('/');
                break;
        }

        return $next($request);
    }
}
