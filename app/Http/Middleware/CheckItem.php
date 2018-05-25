<?php

namespace App\Http\Middleware;

use Closure;

class CheckItem
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
        if($request->jumlah < 1){
            return redirect('stok')->with('error','Stok barang habis');
        }

        return $next($request);
    }
}
