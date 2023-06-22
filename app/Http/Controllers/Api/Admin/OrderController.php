<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Tables;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function getInovice(Request $request)
    {
        try {
            if (!empty($request->tableId)) {
                $table = Tables::where('id', $request->tableId)->first();

                if ($table->status_id == 3) {


                    $invoice = Invoice::where('table_id', $table->id)
                        ->where('status_id', 1)
                        ->first();

                    $results = InvoiceDetail::select('product_id', DB::raw('SUM(quantity) as quantity'))
                        ->groupBy('product_id')
                        ->where('invoice_id', $invoice->id)
                        ->with('products')
                        ->get();


                    return Response::json([
                        'invoiceDetails' => $results,
                        'totalPrice' => $invoice->total_price
                    ], 200);
                }
            }
        } catch (Exception $error) {
            return Response::json([
                'message' => 'Đã có lỗi xảy ra!',
                'error' => $error
            ], 402);
        }
    }

    public function applyInvoice(Request $request)
    {
        try {
            if (!empty($request->tableId)) {
                $table = Tables::where('id', $request->tableId)->first();

                if ($table->status_id == 1) {

                    $invoice = Invoice::create([
                        'user_id' => null,
                        'table_id' => $table->id,
                        'total_price' => $request->price,
                        'quantity' => 1,
                        'status_id' => 1,
                        'staff_id' => null,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'product_id' => $request->productId,
                        'price' => $request->price,
                        'quantity' => 1,
                        'note' => null,
                        'status_id' => 1,
                        'staff_id' => Auth::user()->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

                    $table->status_id = 3;
                    $table->save();

                    return Response::json([
                        'message' => 'Lên đơn thành công!',
                    ], 200);
                }

                if ($table->status_id == 3) {
                    $invoice = Invoice::where('table_id', $table->id)
                        ->where('status_id', 1)
                        ->first();

                    $invoiceDeatail = InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'product_id' => $request->productId,
                        'price' => $request->price,
                        'quantity' => 1,
                        'note' => null,
                        'status_id' => 1,
                        'staff_id' => Auth::user()->id,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);

                    $result = DB::table('invoice_detail')
                        ->selectRaw('SUM(price) AS total_price, COUNT(*) AS product_count')
                        ->where('invoice_id', $invoice->id)
                        ->first();

                    $invoice->quantity = $result->product_count;
                    $invoice->total_price = $result->total_price;
                    $invoice->save();

                    return Response::json([
                        'message' => 'Lên đơn thành công!',
                    ], 200);
                }

                return Response::json([
                    'message' => 'Lên đơn!',
                ], 200);
            }
        } catch (Exception $error) {
            return Response::json([
                'message' => 'Đã có lỗi xảy ra!',
                'error' => $error
            ], 402);
        }
    }

    public function moveTable(Request $request)
    {
        try {
            if (!empty($request->tableId) && !empty($request->tableMoveId)) {
                $invoice = Invoice::where('table_id', $request->tableId)
                    ->where('status_id', 1)
                    ->first();

                $invoice->table_id = $request->tableMoveId;
                $invoice->save();

                $tableNew = Tables::find($request->tableMoveId);
                $tableNew->status_id = 3;
                $tableNew->save();

                $tableCurrent = Tables::find($request->tableId);
                $tableCurrent->status_id = 1;
                $tableCurrent->save();

                return Response::json([
                    'message' => 'thành công!',
                    'data' => $request->all()
                ], 200);
            }
            return Response::json([
                'message' => 'Đã có lỗi xảy ra!',
            ], 402);
        } catch (Exception $error) {
            return Response::json([
                'message' => 'Đã có lỗi xảy ra!',
                'error' => $error
            ], 402);
        }
    }

    public function payOrder(Request $request)
    {
        try {
            $table = Tables::where('id', $request->tableId)->where('status_id', 3)->first();

            $invoice = Invoice::where('table_id', $table->id)
                ->where('status_id', 1)
                ->first();

            $invoice->status_id = 3;
            $invoice->staff_id = Auth::user()->id;
            $invoice->save();

            $table->status_id = 1;
            $table->save();

            return Response::json([
                'message' => 'Thanh toán thành công!',
            ], 200);
        } catch (Exception $error) {
            return Response::json([
                'message' => 'Đã có lỗi xảy ra!',
                'error' => $error
            ], 402);
        }
    }

    public function getMenuOrderProducts(Request $request)
    {
        if (isset($request->category) && !empty($request->category)) {
            $products =  Product::where('category_id', $request->category)->get();
        } else {
            $products =  Product::all();
        }

        return Response::json([
            'products' => $products,
        ], 200);
    }
    public function getMenuOrderCategories(Request $request)
    {
        return Response::json([
            'categories' => Category::all(),
        ], 200);
    }
}
