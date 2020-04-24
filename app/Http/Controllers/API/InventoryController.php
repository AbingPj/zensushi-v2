<?php

namespace App\Http\Controllers\API;

use App\CustomizeClass\ItemClass;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;

class InventoryController extends Controller
{
    public function getItems()
    {
        $items = Item::with('unit','category','item_type')->get();
        $data =  $items->map(function ($item, $key) {
            $item->balance = ItemClass::getItemBalance($item->id);
            return $item;
        });


        return response()->json($items);
    }
}
