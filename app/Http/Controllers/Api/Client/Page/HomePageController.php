<?php

namespace App\Http\Controllers\Api\Client\Page;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function menuCategories()
    {
        $categories = Category::all();
        $menuProducts = Product::limit(4)->get();
        $topProducts = Product::limit(6)->get();

        return Response::json([
            'categories' => $categories,
            'menuProducts' => $menuProducts,
            'topProducts' => $topProducts
        ], 200);
    }
}
