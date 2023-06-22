<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\CreateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CategoriesController extends Controller
{
    public function index()
    {
        return Response::json([
            'categories' => Category::all(),
        ], 200);
    }

    public function create(Request $request)
    {
        $category = Category::where('name', $request->name)->where('categories_type_id', $request->categoriesTypeId)->first();

        if ($category) {
            return Response::json([
                'message' => "Danh mục đã tồn tại",
            ], 402);
        }

        try {
            Category::create([
                'name' => $request->name,
                'parent_id' => $request->parentId,
                'categories_type_id' => $request->categoriesTypeId,
                'image' => $request->image,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return Response::json([
                'message' => 'Thêm sản phẩm thành công',
            ], 200);
        } catch (Exception $e) {
            return Response::json([
                'message' => "Đã có lỗi xảy ra",
            ], 402);
        }
    }

    // get categories type
    function categoriesType()
    {
        $categoryType = DB::table('category_type')->select('id', 'name')->get();
        $category = DB::table('categories')->select('id', 'name')->get();

        return Response::json([
            'categoryType' => $categoryType,
            'category' => $category,
        ], 200);
    }
}
