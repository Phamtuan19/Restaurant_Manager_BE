<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Tables;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{

    public function index()
    {
        // $tables = Tables::with(['invoice' => function ($query) {
        //     $query->where('invoice.status_id', '<', 3)
        //         ->with(['invoiceDetail' => function ($subQuery) {
        //             $subQuery->with('products');
        //         }]);
        // }])->get();

        $tables = Tables::all();

        return Response::json([
            'tables' => $tables,
        ], 200);
    }

    public function getTableClient()
    {
        $tables = Tables::select('id', 'floor_id', 'area_id', 'status_id', 'index_table', 'total_user_sitting')->get();

        return Response::json([
            'tables' => $tables,
        ], 200);
    }

    public function create(Request $request)
    {
        $table = Tables::where('index_table', $request->index_table)->get();

        if (count($table) > 0) {
            return Response::json([
                'message' => 'Danh mục đã tồn tại!',
            ], 402);
        }

        try {
            Tables::create([
                'address_shop' => 'Bắc Từ liêm - Hà Nội',
                'floor' => $request->floor,
                'description' => $request->description,
                'status_id' => 1,
                'image' => $request->image,
                'index_table' => $request->index_table,
                'total_user_sitting' => $request->total_user_sitting,
                'limit_time_book' => null,
                'id_user' => Auth::user()->id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return Response::json([
                'message' => 'Thêm sản phẩm thành công',
                'user' => Auth::user(),
            ], 200);
        } catch (Exception $e) {
            return Response::json([
                'message' => 'Đã có lỗi xảy ra!',
            ], 402);
        }
    }

    public function tableStatus(Request $request)
    {
        if (isset($request->status) && !empty($request->status)) {
            return Response::json([
                'tables' => Tables::where('status_id', $request->status)
                    ->where('id', '!=', $request->tableId)
                    ->get(),
            ], 200);
        }
    }
}
