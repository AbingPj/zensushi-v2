<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Additional;
use App\In_record;
use App\Out_record;
use App\Bone;
use App\Scrap;
use App\CustomizeClass\ItemClass;
use App\Events\RecordsEvent;


class RecordsController extends Controller
{
    public function getRecords(){


        $add = Additional::join('users', 'additionals.user', 'users.id')
        ->join('items', 'additionals.item_id', 'items.id')
        ->join('units', 'items.unit_id', 'units.id')
        ->select(DB::raw(" item_id,
                        date,
                       items.description as 'item',
                       users.name as 'user',
                       additionals.value as 'ADD',
                       '' as 'IN',
                       '' as 'OUT',
                       '' as 'BONES',
                       '' as 'SCRAPS',
                       '' as 'TOTAL',
                       '' as 'DIFFERENCE',
                       'add' as 'record_type',
                       additionals.id as 'id',
                       '' as 'scrap_id',
                       '' as 'bones_id',
                       '' as 'scraps_value',
                       '' as 'bones_value',
                       units.description as 'unit'

                    "));

    $in = In_record::join('users', 'in_records.user', 'users.id')
        ->join('items', 'in_records.item_id', 'items.id')
        ->join('units', 'items.unit_id', 'units.id')
        ->select(DB::raw(" item_id,
                                date,
                               items.description as 'item',
                               users.name as 'user',
                               '' as 'ADD',
                               in_records.value as 'IN',
                               '' as 'OUT',
                               '' as 'BONES',
                               '' as 'SCRAPS',
                               '' as 'TOTAL',
                               '' as 'DIFFERENCE',
                               'in' as 'record_type',
                               in_records.id as 'id',
                               '' as 'scrap_id',
                               '' as 'bones_id',
                               '' as 'scraps_value',
                               '' as 'bones_value',
                               units.description as 'unit'

                            "));

    $data = Out_record::join('users', 'out_records.user', 'users.id')
        ->join('items', 'out_records.item_id', 'items.id')
        ->join('units', 'items.unit_id', 'units.id')
        ->leftJoin('bones', 'out_records.id', 'bones.raw_out_id')
        ->leftJoin('scraps', 'out_records.id', 'scraps.raw_out_id')
        ->select(DB::raw("  out_records.item_id,
                                out_records.date,
                                items.description as 'item',
                                users.name as 'user',
                                '' as 'ADD',
                                '' as 'IN',
                                out_records.value as 'OUT',
                                CONCAT( FORMAT(bones.value,0) ,'g   (', FORMAT((bones.value/1000),2), 'Kilo)' ) as 'BONES',
                                CONCAT( FORMAT(scraps.value,0) ,'g   (', FORMAT((scraps.value/1000),2), 'Kilo)' ) as 'SCRAPS',
                                out_records.total_production as 'TOTAL',
                                out_records.difference as 'DIFFERENCE',
                                'out' as 'record_type',
                                out_records.id as 'id',
                                scraps.id as 'scrap_id',
                                bones.id as 'bones_id',
                                scraps.value as 'scraps_value',
                                bones.value as 'bones_value',
                                units.description as 'unit'
                            "))
        ->union($add)
        ->union($in)
        ->get();

        // $data = In_record::with('item')->get();
        return response()->json($data, 200);


    }
}
