<?php

namespace App\Http\Middleware;

use App\Action;
use Closure;
use Illuminate\Support\Facades\Log;

class ActionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $method = $request->method();

		if (($request->isMethod('post') || $request->isMethod('put') || $request->isMethod('patch') || $request->isMethod('delete')) && !strpos($request->path(), 'action')) {
			$action = new Action();

			$data = $request->all();
			if (array_key_exists('password', $data)) {
				unset($data['password']);
			}
			if (array_key_exists('password_confirmation', $data)) {
				unset($data['password_confirmation']);
			}
			if (is_array($data) && count($data) == 0) {
				$data = null;
			}
			$action->data = $data;

			if (auth('api')->user()) {
				$action->user_id = auth('api')->user()->id;
			} else {
				$action->user_id = null;
			}

			$action->path = $request->path();
			$action->method = $request->method();
			$action->data = json_encode($action->data);
			$action->ip_address = $request->ip();
			$action->save();
		}

		return $next($request);
    }
}
