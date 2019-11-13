<?php

namespace App\Http\Controllers;

use App\In_record;
use App\Raw_product;
use App\Item;
use App\Raw;
use Illuminate\Http\Request;

class ItemsProductController extends Controller
{

    public function getProductItems()
    {

        $products = Raw_product::all();
        if ($products->isNotEmpty()) {
            $products->map(function ($row) {
                $row->item = $row->item;
                $row->unit = $row->item->unit;
                $row->selected = false;
                $row->quantity = 1;
                $row->total_weight = $row->value;
                return $row;
            });
        }
        return response()->json($products);
    }

    public function getProductItemsByRaw($items_id)
    {

        $item = Item::findOrFail($items_id);
        $raw = Raw::findOrFail($item->raw->id);
        $raw_products = $raw->raw_products;
        $raw_products->map(function ($row) {
            return $row->item = $row->item;
        });
        $raw_products->map(function ($row) {
            return $row->unit = $row->item->unit;
        });
        return response()->json(
            $raw_products
        );
    }


    public function StockInRawProduct($item_id)
    {
        $item = Item::findOrFail($item_id);
        $raw = Raw::findOrFail($item->raw->id);
        $raw_products = $raw->raw_products;
        $raw_products->map(function ($row) {
            return $row->item = $row->item;
        });
        return response()->json(
            $raw_products
        );
    }

    public function StockInRawProduct2($item_id, $raw_product_id)
    {
        $item = Item::findOrFail($item_id);
        $raw = Raw::findOrFail($item->raw->id);
        $raw_products = $raw->raw_products;
        $raw_products->map(function ($row) {
            return $row->item = $row->item;
        });
        $selected_raw_product = Raw_product::findORFail($raw_product_id);
        return response()->json(
            $selected_raw_product
        );
        dd($selected_raw_product);
    }

    public function saveProductsIn(Request $request)
    {

        DB::transaction(function () use ($request) {
            $bones = $request->input('bones');
            $scrap = $request->input('scrap');
            $total = $request->input('total');
            $selected_raw = $request->input('selected_raw');
            $selected_raw_out_value = $request->input('selected_raw_out_value');
            $selected_products = $request->input('selected_products');
            $date = $request->input('date');

            foreach ($selected_products as $key => $product) {
            
                $in          = new In_record;
                $in->item_id = $product['item_id'];
                $in->value   = $product['quantity'];
                $in->user    = Auth::id();
                $in->date    = $date;
                $in->save();
             }
            // $value = $request->input('value');
            // $date = $request->input('date');
            // $item = Item::findOrFail($request->input('itemId'));
            // if ($item->item_type_id ==  1) {
            //     $in          = new In_record;
            //     $in->item_id = $item->id;
            //     $in->value   = $value;
            //     $in->user    = Auth::id();
            //     $in->date    = $date;
            //     $in->save();
            //     broadcast(new ItemsEvent($item->id));
            // } elseif ($item->item_type_id ==  3) {
            //     $in          = new In_record;
            //     $in->item_id = $item->id;
            //     $in->value   = $value;
            //     $in->user    = Auth::id();
            //     $in->date    = $date;
            //     $in->save();
            //     broadcast(new ItemsEvent($item->id));
            // }
        });
    }
}
