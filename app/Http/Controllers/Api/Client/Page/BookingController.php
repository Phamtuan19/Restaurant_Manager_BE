<?php

namespace App\Http\Controllers\Api\Client\Page;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingProduct;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class BookingController extends Controller
{
    public static $PRODUCT_NUMBER = 8;


    public function menuBoking(Request $request)
    {
        $categories = Category::select('id', 'name', 'image')->where('categories_type_id', '!=', 3)->get();
        $products = Product::select('id', 'code', 'name', 'price', 'price_sale', 'image');

        if (isset($request->q) && !empty($request->q)) {
            $requestName = $request->q;
            $products = $products->where('name', 'like', '%' . $requestName . '%');
        }

        if (isset($request->categoryId) && !empty($request->categoryId)) {
            $requestCategoryId = $request->categoryId;
            $products = $products->where('category_id', $requestCategoryId);
        }

        $products = $products->paginate(static::$PRODUCT_NUMBER);

        return Response::json([
            'categories' => $categories,
            'products' => $products,
        ], 200);
    }

    public function create(Request $request)
    {
        try {
            $randomNumber = rand(10000, 99999);

            // $booking = Booking::create([
            //     'booking_code' => $randomNumber,
            //     'table_id' => $request->tableId,
            //     'user_id' => null,
            //     'name' => $request->name,
            //     'phone' => $request->phone,
            //     'booking_date' => $request->date,
            //     'booking_time' => $request->time,
            //     'party_size' => $request->partySize,
            //     'status_booking_id' => 1,
            //     'booking_notes' => $request->note,
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ]);

            // if ($booking && !empty($request->products)) {
            //     $products = $request->products;

            //     foreach ($products as $value) {
            //         BookingProduct::create([
            //             'booking_id' => $booking->id,
            //             'product_id' => $value['id'],
            //             'quantity' => $value['quantity'],
            //             'created_at' => date('Y-m-d H:i:s'),
            //             'updated_at' => date('Y-m-d H:i:s'),
            //         ]);
            //     }
            // }

            return Response::json([
                'message' => 'Đặt bàn thành công!',
            ], 200);
        } catch (Exception $e) {
            return Response::json([
                'message' => 'Đã có lỗi xảy ra!',
                'e' => $e->getMessage(),
            ], 402);
        }
    }
}
