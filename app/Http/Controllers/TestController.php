<?php

namespace App\Http\Controllers;

use App\CustomizeClass\ItemClass;
use App\In_record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    //
    public function test2(){
        ItemClass::updateProductionTotalAndDifference(2);
    }

    public function test()
    {

        
        // ItemClass::getItemBalance();


        $item_id = 1;
        $date = '2019-12-01';

        $items_in_others = DB::table('In_records')
            ->where('item_id', $item_id)
            ->whereDate('date', '<', date($date))
            ->orderBy('date', 'asc')
            ->get();
        (!empty($items_in_others)) ?
            $OTHER_IN = $items_in_others->sum('value') : $OTHER_IN = 0;
        $items_in1 = DB::table('In_records')
            ->where('item_id', $item_id)
            ->whereDate('date', '=', date($date))
            ->orderBy('date', 'asc')
            ->get();
        foreach ($items_in1 as $key => $row) {
            $OTHER_IN = $OTHER_IN + $row->value;
            $row->balance = $OTHER_IN;
        }






        return response()->json($items_in1);

        $balance = ItemClass::getItemBalanceWithSelectedDate($item_id, $date);
        dd($balance);
    }
}
