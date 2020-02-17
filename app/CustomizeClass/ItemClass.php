<?php

namespace App\CustomizeClass;

use App\In_record;
use App\Out_record;
use App\Additional;
use App\Events\RecordsEvent;
use CreateAdditionalRecordsTable;
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
  
  
  static function updateProductionTotalAndDifference($raw_out_id)
  {
    $out = Out_record::find($raw_out_id);
    $out_quantity = $out->value;
    $out_value = $out->item->raw->value;
    $total_out = $out_value * $out_quantity;
    $item_in_products = In_record::all()->where('raw_out_id', $raw_out_id);
    $total = 0;
    foreach ($item_in_products as $key => $product) {
        $quantity = $product->value;
        $value = $product->item->raw_product->value;
        $total_per_item = $quantity * $value;
        $total = $total + $total_per_item;
    }
    $scrap = $out->scrap->value;
    $total = $total + $scrap;
    $bones = $out->bone->value;
    $total = $total + $bones;
    $out->total_production = $total;
    $out->difference = ($total - $total_out);
    $out->save();
    broadcast(new RecordsEvent($out->id));
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
