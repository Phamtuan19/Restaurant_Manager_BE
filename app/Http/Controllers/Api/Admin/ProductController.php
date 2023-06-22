<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\CreateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    public function index()
    {
        return Response::json([
            'products' => Product::all(),
        ], 200);
    }

    public function create(Request $request)
    {
        $randomNumber = rand(10000, 99999);
        try {
            Product::create([
                'code' => !empty($request->code) ? $request->code : $randomNumber,
                'name' => $request->name,
                'category_id' => $request->categories,
                'cost_capital' => $request->costCapital,
                'price' => $request->price,
                'price_sale' => $request->priceSale,
                'description' => null,
                'image' => $request->image,
                "user_id" => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return Response::json([
                'message' => 'Thêm sản phẩm thành công',
            ], 200);
        } catch (Exception $e) {
            return Response::json([
                'message' => 'Đã có lỗi xảy ra!',
                'e' => $e
            ], 402);
        }
    }

    public function show(Request $request)
    {
        if (!empty($request->id)) {
            $product = Product::find($request->id);
            $categories = Category::all();

            return Response::json([
                'product' => $product,
                'categories' => $categories
            ], 200);
        }
    }

    public function update(Request $request)
    {
        if (!empty($request->id)) {
            $product = Product::find($request->id);

            $product->name = $request->name;
            $product->category_id = $request->categories;
            $product->cost_capital = $request->costCapital;
            $product->price = $request->price;
            $product->price_sale = $request->priceSale;
            $product->description = null;
            $product->image = $request->image;
            $product->updated_at = date('Y-m-d H:i:s');

            $product->save();

            return Response::json([
                "message" => "Cập nhật thành công!",
            ], 200);
        }
    }
}
