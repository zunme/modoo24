<?php
namespace App\Traits;
use Carbon\Carbon;

trait ApiResponser
{
	protected function success($data=[], $message = null, $code = 200)
	{
		return response()->json([
			'status' => 'Success',
			'message' => $message,
			'data' => $data
		], $code);
	}
	protected function error($message, $code = 422, $data = null)
	{
		return response()->json([
			'status' => 'Error',
			'message' => $message,
			'data' => $data
		], $code);
	}
}