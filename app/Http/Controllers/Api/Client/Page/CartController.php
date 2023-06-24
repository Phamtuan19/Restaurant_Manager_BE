<?php

namespace App\Http\Controllers\Api\Client\Page;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Exception;

class CartController extends Controller
{
    public function orderOnline(Request $request)
    {
        try {
            $invoice = Invoice::create([
                'booking_id' => null,
                'user_id' => Auth::user() ? Auth::user()->id : null,
                'table_id' => null,
                'quantity' => count($request->products),
                'status_id' => 1,
                'payment_id' => null,
                'staff_id' => null,
                'invoice_type' => null,

            ]);

            $products = $request->products;

            if ($invoice && !empty($products)) {

                foreach ($products as $product) {
                    InvoiceDetail::create([
                        'invoice_id' => $invoice->id,
                        'product_id' => $product['id'],
                        'quantity' => $product['quantity'],
                        'note' => null,
                        'status_id' => 1,
                        'staff_id' => null,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }

                return Response::json([
                    'message' => 'Đặt hàng thành công!',
                ], 200);
            }
        } catch (Exception $error) {
            return Response::json([
                'message' => 'Đã có lỗi xảy ra!',
                'error' => $error->getMessage()
            ], 402);
        }
    }
}
