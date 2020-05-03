<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item_type;
use App\Raw;
use App\Unit;
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

    public function deliveryRequest()
    {
        return view('app.pages.delivery-request.delivery-request');
    }

    public function delivery()
    {
        return view('app.pages.delivery.delivery');
    }

    public function notification()
    {
        return view('app.pages.notification.notification');
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
    public function production3($item_id, $product_item_id)
    {

        $item_raw_stock_out = null;
        return view(
            'app.pages.items.items-raw-product-in',
            compact('item_id', 'item_raw_stock_out', 'product_item_id')
        );
    }

    public function production4($item_id, $product_item_id, $item_raw_stock_out)
    {

        return view(
            'app.pages.items.items-raw-product-in',
            compact('item_id', 'item_raw_stock_out', 'product_item_id')
        );
    }

    public function zen()
    {
        $page_title = "Dashboard";
        return view('pages.home.home', compact('page_title'));
    }
    public function zenInventory()
    {
        $page_title = "Inventory";
        return view('pages.items.items', compact('page_title'));
    }

    public function zenCreateItem($id)
    {
        if (!($id >= 1 && $id <= 3)) {
            return view('app.pages.items.items');
        }
        $itemType   = Item_type::find($id);
        $categories = Category::all();
        $units      = Unit::all();
        $rawItems = Raw::all();

        if ($rawItems->isNotEmpty()) {
            $rawItems->map(function ($row) {
                return $row->item = $row->item;
            });
        }
        $page_title = "Inventory";
        return view('pages.items.items-create', compact('page_title','itemType', 'categories', 'units', 'rawItems'));
    }

    public function zenRecords()
    {
        $page_title = "Records";
        return view('pages.records.records', compact('page_title'));
    }

    public function zenRequest()
    {
        $page_title = "Delivery Request";
        return view('pages.delivery-request.delivery-request', compact('page_title'));
    }

    public function zenDelivery()
    {
        $page_title = "Deliveries";
        return view('pages.delivery.delivery', compact('page_title'));
    }


    public function zenUsers()
    {
        $page_title = "Users";
        return view('pages.users.users', compact('page_title'));
    }

    public function zenUsersCreate()
    {
        $page_title = "Users";
        return view('pages.users.users-create', compact('page_title'));
    }



    public function zenProduction()
    {
        $page_title = "Production";
        $item_id = null;
        $item_raw_stock_out = null;
        $product_item_id = null;
        return view(
            'pages.items.items-raw-product-in',
            compact('page_title', 'item_id', 'item_raw_stock_out', 'product_item_id')
        );
    }
    public function zenProduction2($item_id)
    {
        $page_title = "Production";
        $item_raw_stock_out = null;
        $product_item_id = null;
        return view(
            'pages.items.items-raw-product-in',
            compact('page_title', 'item_id', 'item_raw_stock_out', 'product_item_id')
        );
    }
    public function zenProduction3($item_id, $product_item_id)
    {
        $page_title = "Production";
        $item_raw_stock_out = null;
        return view(
            'pages.items.items-raw-product-in',
            compact('page_title', 'item_id', 'item_raw_stock_out', 'product_item_id')
        );
    }

    public function zenProduction4($item_id, $product_item_id, $item_raw_stock_out)
    {
        $page_title = "Production";
        return view(
            'pages.items.items-raw-product-in',
            compact('page_title', 'item_id', 'item_raw_stock_out', 'product_item_id')
        );
    }
}
