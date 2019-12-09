<?php

namespace App\Http\Controllers;

use App\Bone;
use App\In_record;
use App\Raw_product;
use App\Item;
use App\Out_record;
use App\Raw;
use App\Scrap;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $products = $raw->raw_products;
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

    // public function getProductItemsByRaw($items_id)
    // {

    //     $item = Item::findOrFail($items_id);
    //     $raw = Raw::findOrFail($item->raw->id);
    //     $raw_products = $raw->raw_products;
    //     $raw_products->map(function ($row) {
    //         return $row->item = $row->item;
    //     });
    //     $raw_products->map(function ($row) {
    //         return $row->unit = $row->item->unit;
    //     });
    //     return response()->json(
    //         $raw_products
    //     );
    // }


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
            $difference  = $request->input('difference');
        

            $selected_raw = $request->input('selected_raw');
            $selected_raw_item_id = $selected_raw['item_id'];
            $selected_raw_out_value = $request->input('selected_raw_out_value');
            $selected_products = $request->input('selected_products');
            $date = $request->input('date');
            // dd($selected_products);

            

            $raw_out = new Out_record;
            $raw_out->item_id = $selected_raw_item_id;
            $raw_out->value = $selected_raw_out_value;
            $raw_out->date = $date;
            $raw_out->user  = Auth::id();
            $raw_out->total_production = $total;
            $raw_out->difference = $difference;
            $raw_out->save();



            $bones_obj = new Bone();
            $bones_obj->item_id     = $selected_raw_item_id;
            $bones_obj->value       = $bones;
            $bones_obj->date        = $date;
            $bones_obj->user        = Auth::id();
            $bones_obj->raw_out_id  = $raw_out->id;
            $bones_obj->save();
            dump($bones);
            dump($bones_obj);

            $scrap_obj = new Scrap();
            $scrap_obj->item_id     = $selected_raw_item_id;
            $scrap_obj->value       = $scrap;
            $scrap_obj->date        = $date;
            $scrap_obj->user        = Auth::id();
            $scrap_obj->raw_out_id  = $raw_out->id;
            $scrap_obj->save();
            dump($scrap);
            dump($scrap_obj);


            

            foreach ($selected_products as $key => $product) {
                $in          = new In_record;
                $in->item_id = $product['item_id'];
                $in->value   = $product['quantity'];
                $in->user    = Auth::id();
                $in->date    = $date;
                $in->raw_out_id = $raw_out->id;
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
