<?php

namespace App\CustomizeClass;

use App\In_record;
use App\Out_record;
use App\Additional;
use Illuminate\Support\Facades\DB;

class ItemClass
{

  static function getItemBalance($item_id)
  {
    $balance = 0;
    $items_in = In_record::all()->where('item_id', $item_id);
    $items_out = Out_record::all()->where('item_id', $item_id);
    $items_add = Additional::all()->where('item_id', $item_id);

    (!empty($items_in)) ?
      $IN = $items_in->sum('value') : $IN = 0;

    (!empty($items_out)) ?
      $OUT = $items_out->sum('value') : $OUT = 0;

    (!empty($items_add)) ?
      $ADD = $items_add->sum('value') : $ADD = 0;

    $balance = ($IN + $ADD) - $OUT;
    return $balance;
  }

  // static function getItemBalanceWithSelectedDate($item_id, $date)
  // {
  //   $balance = 0;

  //   // $items_in = In_record::all()->where('item_id', $item_id);

  //   // $items_out = Out_record::all()->where('item_id', $item_id);
  //   // $items_add = Additional::all()->where('item_id', $item_id);

  //   $items_in = DB::table('In_records')
  //     ->where('item_id', $item_id)
  //     ->whereDate('date', '<=', date($date))->get();

  //   $items_out = DB::table('Out_records')
  //     ->where('item_id', $item_id)
  //     ->whereDate('date', '<=', date($date))->get();

  //   $items_add = DB::table('Additionals')
  //     ->where('item_id', $item_id)
  //     ->whereDate('date', '<=', date($date))->get();


  //   (!empty($items_in)) ?
  //     $IN = $items_in->sum('value') : $IN = 0;

  //   (!empty($items_out)) ?
  //     $OUT = $items_out->sum('value') : $OUT = 0;

  //   (!empty($items_add)) ?
  //     $ADD = $items_add->sum('value') : $ADD = 0;

  //   $balance = ($IN + $ADD) - $OUT;
  //   return $balance;
  // }
}
