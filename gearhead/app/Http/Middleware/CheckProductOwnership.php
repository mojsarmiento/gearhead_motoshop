<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Product;

class CheckProductOwnership
{
    public function handle($request, Closure $next)
    {
        $productId = $request->route('id'); // Adjust this based on your route structure
        $product = Product::find($productId);

        if ($product && $product->user_id == auth()->id()) {
            return $next($request);
        }

        abort(403, 'Unauthorized'); // or redirect to a 403 page
    }
}
