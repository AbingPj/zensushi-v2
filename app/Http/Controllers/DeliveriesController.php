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
                return $row;
            });
        }
        return response()->json($items);
    }

    public function serchProducts($product)
    {

        $items = Item::where("description", "like",'%'.$product.'%')
            ->orWhere("id", "like",'%'.$product.'%')
            ->where("item_type_id", "<>", "1")
            ->get();
            if ($items->isNotEmpty()) {
            $items->map(function ($row) {
                $row->balance =  ItemClass::getItemBalance($row->id);
                $row->unit_desc = $row->unit->description;
                return $row;
            });
        }
        return response()->json($items);
    }
}
