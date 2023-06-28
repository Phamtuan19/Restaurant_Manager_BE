<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

class MenuPageController extends Controller
{
    public static $PAGINATE_NUMBER = 12;

    public function productList(Request $request)
    {
        $products = DB::table('products')->select('*');

        if (isset($request->q) && !empty($request->q)) {
            $requestName = $request->q;
            $products = $products->where('name', 'like', '%' . $requestName . '%');
        }

        if (isset($request->categoryId) && !empty($request->categoryId)) {
            $categoryId = explode(',', $request->categoryId);
            $products = $products->where('category_id', $categoryId);
        }

        $products = $products->paginate(static::$PAGINATE_NUMBER);

        return Response::json([
            'products' => $products,
        ], 200);
    }

    public function filterQuery()
    {
        $categories = Category::where('categories_type_id', '!=', 3)
            ->whereNull('parent_id')
            ->withCount('products')
            ->get();

        return Response::json([
            'categories' => $categories,
        ], 200);
    }
}
