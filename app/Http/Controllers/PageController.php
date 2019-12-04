<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home()
    {
        return view('app.pages.home.home');
    }
    public function items()
    {
        return view('app.pages.items.items');
    }
    public function records()
    {
        return view('app.pages.records.records');
    }

    public function production()
    {
    
        $item_id = null;
        $item_raw_stock_out = null;
        $product_item_id = null;
        return view(
                    'app.pages.items.items-raw-product-in',
                    compact('item_id', 'item_raw_stock_out', 'product_item_id')
                    );
    }
    public function production2($item_id)
    {
    
        $item_raw_stock_out = null;
        $product_item_id = null;
        return view(
                    'app.pages.items.items-raw-product-in',
                    compact('item_id', 'item_raw_stock_out', 'product_item_id')
                    );
    }
    public function production3( $item_id, $product_item_id )
    {
    
        $item_raw_stock_out = null;
        return view(
                    'app.pages.items.items-raw-product-in',
                    compact('item_id', 'item_raw_stock_out', 'product_item_id')
                    );
    }

    public function production4( $item_id, $product_item_id, $item_raw_stock_out )
    {
    
        return view(
                    'app.pages.items.items-raw-product-in',
                    compact('item_id', 'item_raw_stock_out', 'product_item_id')
                    );
    }
}
