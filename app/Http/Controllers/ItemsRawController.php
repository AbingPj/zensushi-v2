<?php

namespace App\Http\Controllers;

use App\Raw;
use App\Item;
use App\In_record;
use App\Out_record;


use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Events\ItemsEvent;


class ItemsRawController extends Controller
{
    public function getRawItems(){
        $rawItems = Raw::all();
        // foreach ($rawItems as $key => $raw) {
        //     $raw->item = $raw->item;
        // }
        if ($rawItems->isNotEmpty()) {
            $rawItems->map(function ($row) {
                return $row->item = $row->item;
            });
        }
        return response()->json($rawItems);
    }

    public function StockInRaw(Request $request)
    {

        DB::transaction(function () use ($request) {
            $value = $request->input('value');
            $date = $request->input('date');
            $item = Item::findOrFail($request->input('itemId'));
            if ($item->item_type_id ==  1) {
                $in          = new In_record;
                $in->item_id = $item->id;
                $in->value   = $value;
                $in->user    = Auth::id();
                $in->date    = $date;
                $in->save();
                broadcast(new ItemsEvent($item->id));
            } elseif ($item->item_type_id ==  3) {
                $in          = new In_record;
                $in->item_id = $item->id;
                $in->value   = $value;
                $in->user    = Auth::id();
                $in->date    = $date;
                $in->save();
                broadcast(new ItemsEvent($item->id));
            }
        });
    }

    public function StockOutRaw(Request $request)
    {
        DB::transaction(function () use ($request) {
            $value = $request->input('value');
            $date = $request->input('date');
            $item = Item::findOrFail($request->input('itemId'));

            if ($item->item_type_id ==  1) {
                $out          = new Out_record();
                $out->item_id = $item->id;
                $out->value   = $value;
                $out->user    = Auth::id();
                $out->date    = $date;
                $out->save();
                broadcast(new ItemsEvent($item->id));
            } elseif ($item->item_type_id == 3) {
                $out          = new Out_record();
                $out->item_id = $item->id;
                $out->value   = $value;
                $out->user    = Auth::id();
                $out->date    = $date;
                $out->save();
                broadcast(new ItemsEvent($item->id));
            }
        });
    }
    
}
