<?php

namespace App\Http\Controllers;

use App\CustomizeClass\ItemClass;
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
    public function getRawItems()
    {
        $rawItems = Raw::all();
        // foreach ($rawItems as $key => $raw) {
        //     $raw->item = $raw->item;
        // }
       
        if ($rawItems->isNotEmpty()) {
            $rawItems->map(function ($row) {
                $row->selected = false;
                $balance =  ItemClass::getItemBalance($row->item_id);
                $row->item = $row->item;
                $row->balance = $balance;
                $row->unit = $row->item->unit;
                return $row;
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
            $value = floatval($request->input('value'));
            $date = $request->input('date');
            $item = Item::findOrFail($request->input('itemId'));
            $balance =  ItemClass::getItemBalance($item->id);
            if (!($value > $balance)) {
                if (!($balance == 0)) {
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
                    } elseif ($item->item_type_id == 2) {
                        $out          = new Out_record();
                        $out->item_id = $item->id;
                        $out->value   = $value;
                        $out->user    = Auth::id();
                        $out->date    = $date;
                        $out->save();
                        broadcast(new ItemsEvent($item->id));
                    }
                }
            }
        });
    }
    public function getItemBalance($item_id)
    {
        ItemClass::getItemBalance($item_id);
    }
}
