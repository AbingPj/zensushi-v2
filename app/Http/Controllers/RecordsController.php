<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Additional;
use App\In_record;
use App\Out_record;
use App\Bone;
use App\CustomizeClass\ItemClass;
use App\Events\RecordsEvent;
use App\Scrap;
// use App\Http\Controllers\DB;
use Illuminate\Support\Facades\DB;


class RecordsController extends Controller
{
    public function deleteRecord(Request $request)
    {

        $id = $request->input('id');
        $scrap_id = $request->input('scrap_id');
        $bones_id = $request->input('bones_id');

        $record_type = $request->input('record_type');
        if ($record_type == 'add') {
            $record = Additional::findOrFail($id);
            $record->delete();
            broadcast(new RecordsEvent($record->id));
        } elseif ($record_type == 'in') {
            $record = In_record::findOrFail($id);
            $raw_out_id = $record->raw_out_id;
            $record->delete();
            if ($raw_out_id != null) {
                ItemClass::updateProductionTotalAndDifference($raw_out_id);
            } else {
                broadcast(new RecordsEvent($record->id));
            }
           
        } elseif ($record_type == 'out') {
            $record = Out_record::findOrFail($id);
            if ($record->item->item_type_id == 1) {
                $scrap_record  = Scrap::findOrFail($scrap_id);
                $scrap_record->delete();
                $bones_record = Bone::findOrFail($bones_id);
                $bones_record->delete();
                // $item_in_products = In_record::all()->where('raw_out_id', $record->id);
                // foreach ($item_in_products as $key => $product) {
                //     $product->delete();
                // }
                $record->delete();
                broadcast(new RecordsEvent($record->id));
            } else {
                $record->delete();
                broadcast(new RecordsEvent($record->id));
            }
        }
    }

    public function updateRecord(Request $request)
    {



        $id = $request->input('id');
        $scrap_id = $request->input('scrap_id');
        $bones_id = $request->input('bones_id');

        $record_type = $request->input('record_type');
        if ($record_type == 'add') {
            $record = Additional::findOrFail($id);
            $record->value = $request->input('ADD');
            $record->save();
            broadcast(new RecordsEvent($record->id));
        } elseif ($record_type == 'in') {
            $record = In_record::findOrFail($id);
            $record->value =  $request->input('IN');
            $record->save();
            $raw_out_id = $record->raw_out_id;

            if ($raw_out_id != null) {
                ItemClass::updateProductionTotalAndDifference($raw_out_id);
            } else {
                broadcast(new RecordsEvent($record->id));
            }
        } elseif ($record_type == 'out') {
            $record = Out_record::findOrFail($id);
            $record->value = $request->input('OUT');
            $record->save();
            if ($record->item->item_type_id == 1) {
                $scrap_record  = Scrap::findOrFail($scrap_id);
                $scrap_record->value = $request->input('scraps_value');
                $scrap_record->save();
                $bones_record = Bone::findOrFail($bones_id);
                $bones_record->value = $request->input('bones_value');
                $bones_record->save();
                ItemClass::updateProductionTotalAndDifference($record->id);
            } else {
                broadcast(new RecordsEvent($record->id));
            }
        }
    }

    public function getRecords()
    {
        $request = request();

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



        // $query = Out_record::join('users', 'out_records.user', 'users.id')
        //     ->join('items', 'out_records.item_id', 'items.id')
        //     ->join('bones', 'out_records.id', 'bones.raw_out_id')
        //     ->join('scraps', 'out_records.id', 'scraps.raw_out_id')
        //     ->select(DB::raw("  out_records.item_id,
        //                         out_records.date,
        //                         items.description as 'item',
        //                         users.name as 'user',
        //                         '' as 'ADD',
        //                         '' as 'IN',
        //                         out_records.value as 'OUT',
        //                         IF(items.unit_id = 4, CONCAT((ROUND(bones.value/1000, 2)),' kilo'), CONCAT(bones.value,' g')) as 'BONES',
        //                         IF(items.unit_id = 4, CONCAT((ROUND(scraps.value/1000, 2)),' kilo'), CONCAT(scraps.value,' g')) as 'SCRAPS'
        //                     "))
        //     ->union($add)
        //     ->union($in)
        //     ->newQuery();

        $query = Out_record::join('users', 'out_records.user', 'users.id')
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
            ->newQuery();




        // units.description as 'unit


        // $out = Out_record::join('users', 'out_records.user', 'users.id')
        //     ->join('items', 'out_records.item_id', 'items.id')
        //     ->select(DB::raw(" item_id,
        //                         date,
        //                         items.description as 'item',
        //                         users.name as 'user',
        //                         '' as 'ADD',
        //                         '' as 'IN',
        //                         out_records.value as 'OUT',
        //                         '' as 'BONES',
        //                         '' as 'SCRAPS'
        //                     "));

        // $bones = Bone::join('users', 'bones.user', 'users.id')
        //     ->join('items', 'bones.item_id', 'items.id')
        //     ->select(DB::raw(" item_id,
        //                        date,
        //                        items.description as 'item',
        //                        users.name as 'user',
        //                        '' as 'ADD',
        //                        '' as 'IN',
        //                        '' as 'OUT',
        //                        bones.value as 'BONES',
        //                        '' as 'SCRAPS'
        //                     "));

        // $query = Scrap::join('users', 'scraps.user', 'users.id')
        //     ->join('items', 'scraps.item_id', 'items.id')
        //     ->select(DB::raw(" item_id,
        //                        date,
        //                        items.description as 'item',
        //                        users.name as 'user',
        //                        '' as 'ADD',
        //                        '' as 'IN',
        //                        '' as 'OUT',
        //                        '' as 'BONES',
        //                        scraps.value as 'SCRAPS'
        //                     "))
        //     ->union($add)
        //     ->union($in)
        //     ->union($out)
        //     ->union($bones)
        //     ->newQuery();;

        if (request('sort') != "") {
            $sorts = explode(',', request()->sort);
            foreach ($sorts as $sort) {
                list($sortCol, $sortDir) = explode('|', $sort);
                $query = $query->orderBy($sortCol, $sortDir);
            }
        } else {
            $query = $query->orderBy('date', 'desc');
        }

        if ($request->exists('filter')) {
            $query->where(function ($q) use ($request) {
                $value = "%{$request->filter}%";
                $q->where('item_id', 'like', $value)
                    ->orWhere('date', 'like', $value)
                    ->orWhere('item', 'like', $value)
                    ->orWhere('ADD', 'like', $value)
                    ->orWhere('IN', 'like', $value)
                    ->orWhere('BONES', 'like', $value)
                    ->orWhere('SCRAPS', 'like', $value)
                    ->orWhere('OUT', 'like', $value);
            });
        }

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $pagination = $query->paginate($perPage);
        $pagination->appends([
            'sort'     => request()->sort,
            'filter'   => request()->filter,
            'per_page' => request()->per_page
        ]);

        return response()->json(
            $pagination
        )
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }
}
