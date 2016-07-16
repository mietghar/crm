<?php namespace App\Http\Middleware;

use Closure;

class SuperUser {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
                $user = $request->user();
                if($user && $user->admin == 1){
                    return $next($request);

                }
                abort(404, 'Nie masz odpowiednich uprawnień!!!');
	}

}
