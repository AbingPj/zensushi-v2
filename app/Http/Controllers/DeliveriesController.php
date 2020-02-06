<?php

namespace App\Http\Controllers;

use App\CustomizeClass\ItemClass;
use App\Item;
use Illuminate\Http\Request;

class DeliveriesController extends Controller
{
    public function getProducts()
    {

        $items = Item::all()->where("item_type_id", "<>", "1");
        if ($items->isNotEmpty()) {
            $items->map(function ($row) {
                $row->balance =  ItemClass::getItemBalance($row->id);
                $row->unit_desc = $row->unit->description;
                $row->selected = "false";
                return $row;
            });
        }
        return response()->json($items);
    }

    public function serchProducts($product)
    {
        $prod = $product;
        // $items = Item::whereRaw("item_type_id <> 1 AND (description LIKE '%" . $prod . "%' OR id LIKE '%" . $prod . "')")->get();
        $items = Item::where('item_type_id', '<>', 1)
            ->where(function ($query) use ($prod) {
                return $query->where("description", "LIKE", "%$prod%")
                    ->orWhere("id", "like", "%$prod%");
            })
            ->get();

        if ($items->isNotEmpty()) {
            $items->map(function ($row) {
                $row->balance =  ItemClass::getItemBalance($row->id);
                $row->unit_desc = $row->unit->description;
                $row->selected = "false";
                return $row;
            });
        }
        return response()->json($items);
    }

    public function sendDeliveryRequest(Request $request)
    {
        $branch = $request->input('branch');
        $products = $request->input('products');
        dd($request);
    }

    public function sendDelivery(Request $request)
    {
        $branch = $request->input('branch');
        $products = $request->input('products');
        dd($request);
    }
}
