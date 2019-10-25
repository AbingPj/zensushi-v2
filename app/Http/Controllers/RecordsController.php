<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Additional;
use App\In_record;
use App\Out_record;
use App\Bone;
use App\Scrap;
// use App\Http\Controllers\DB;
use Illuminate\Support\Facades\DB;


class RecordsController extends Controller
{
    public function getRecords()
    {
        $request = request();

        $add = Additional::join('users', 'additionals.user', 'users.id')
            ->join('items', 'additionals.item_id', 'items.id')
            ->select(DB::raw(" item_id,
                            date,
                           items.description as 'item',
                           users.name as 'user',
                           additionals.value as 'ADD',
                           '' as 'IN',
                           '' as 'OUT',
                           '' as 'BONES',
                           '' as 'SCRAPS'
                        "));

        $in = In_record::join('users', 'in_records.user', 'users.id')
            ->join('items', 'in_records.item_id', 'items.id')
            ->select(DB::raw(" item_id,
                                    date,
                                   items.description as 'item',
                                   users.name as 'user',
                                   '' as 'ADD',
                                   in_records.value as 'IN',
                                   '' as 'OUT',
                                   '' as 'BONES',
                                   '' as 'SCRAPS'
                                "));

        $out = Out_record::join('users', 'out_records.user', 'users.id')
            ->join('items', 'out_records.item_id', 'items.id')
            ->select(DB::raw(" item_id,
                                date,
                                items.description as 'item',
                                users.name as 'user',
                                '' as 'ADD',
                                '' as 'IN',
                                out_records.value as 'OUT',
                                '' as 'BONES',
                                '' as 'SCRAPS'
                            "));

        $bones = Bone::join('users', 'bones.user', 'users.id')
            ->join('items', 'bones.item_id', 'items.id')
            ->select(DB::raw(" item_id,
                               date,
                               items.description as 'item',
                               users.name as 'user',
                               '' as 'ADD',
                               '' as 'IN',
                               '' as 'OUT',
                               bones.value as 'BONES',
                               '' as 'SCRAPS'
                            "));

        $query = Scrap::join('users', 'scraps.user', 'users.id')
            ->join('items', 'scraps.item_id', 'items.id')
            ->select(DB::raw(" item_id,
                               date,
                               items.description as 'item',
                               users.name as 'user',
                               '' as 'ADD',
                               '' as 'IN',
                               '' as 'OUT',
                               '' as 'BONES',
                               scraps.value as 'SCRAPS'
                            "))
            ->union($add)
            ->union($in)
            ->union($out)
            ->union($bones)
            ->newQuery();;

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
