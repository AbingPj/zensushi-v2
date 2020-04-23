<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;

class InventoryController extends Controller
{
    public function getItems()
    {
        $items = Item::all();
        return response()->json($items);
    }
}
