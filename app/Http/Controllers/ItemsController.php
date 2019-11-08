<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\ItemsEvent;
use App\In_record;
use Illuminate\Http\Request;
use App\Item;
use App\Item_type;
use App\Additional;
use App\Not_raw;
use App\Out_record;
use App\Raw;
use App\Raw_product;
use App\Unit;
use Auth;
use Illuminate\Support\Facades\DB;


class ItemsController extends Controller
{
    public function triggerPusher()
    {
        broadcast(new ItemsEvent('HELLO WORLD'));
    }


    public function items()
    {
        $items = Item::all();
        return response()->json($items);
    }

    public function item_types()
    {
        $items = Item_type::all();
        return response()->json($items);
    }

    public function showUpdateItemModal($id)
    {

        $item =  Item::find($id);

        $item->selected_category = $item->category;
        $item->selected_unit     = $item->unit;
        $categories              = Category::all();
        $units                   = Unit::all();
        $raws                    = Raw::all();
        if ($item->item_type_id == 1) {
            $data = array(
                "item"       => $item,
                "categories" => $categories,
                "units"      => $units,
                "raw_value"  => $item->raw->value
            );
        } elseif ($item->item_type_id == 2) {
            if ($raws->isNotEmpty()) {
                $raws->map(function ($row) {
                    return $row->item = $row->item;
                });
            }
            $selectedRaw = $raws->firstWhere('id', $item->raw_product->raw_id);
            $data = array(
                "item"              => $item,
                "categories"        => $categories,
                "units"             => $units,
                "raws"              => $raws,
                "raw_product_value" => $item->raw_product->value,
                "selected_raw"      => $selectedRaw

            );
        } elseif ($item->item_type_id == 3) {
            $data = array(
                "item"       => $item,
                "categories" => $categories,
                "units"      => $units
            );
        }

        return response()->json($data);
    }




    public function createItem($id)
    {
        if (!($id >= 1 && $id <= 3)) {
            return view('app.pages.items.items');
        }
        $itemType   = Item_type::find($id);
        $categories = Category::all();
        $units      = Unit::all();
        // $rawItems = Item::All()->where('item_type_id', '1');
        $rawItems = Raw::all();
        // foreach ($rawItems as $key => $raw) {
        //     $raw->item = $raw->item;
        // }
        if ($rawItems->isNotEmpty()) {
            $rawItems->map(function ($row) {
                return $row->item = $row->item;
            });
        }
        return view('app.pages.items.items-create', compact('itemType', 'categories', 'units', 'rawItems'));
    }


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


    public function getProductItems(){
        
        $products = Raw_product::all();
        // foreach ($rawItems as $key => $raw) {
        //     $raw->item = $raw->item;
        // }
        if ($products->isNotEmpty()) {
            $products->map(function ($row) {
                $row->item = $row->item;
                $row->unit = $row->item->unit;
                $row->selected = false;
                return $row;
            });
        }
     
      
        return response()->json($products);
    }
    
    public function getProductItemsByRaw($items_id){
        
        $item = Item::findOrFail($items_id);
        $raw = Raw::findOrFail($item->raw->id);
        $raw_products = $raw->raw_products;
        $raw_products->map(function ($row) {
            return $row->item = $row->item;
        });
        $raw_products->map(function ($row) {
            return $row->unit = $row->item->unit;
        });
        return response()->json(
            $raw_products
        );
    }

    public function StockInRawProduct($item_id)
    {
        $item = Item::findOrFail($item_id);
        $raw = Raw::findOrFail($item->raw->id);
        $raw_products = $raw->raw_products;
        $raw_products->map(function ($row) {
            return $row->item = $row->item;
        });
      
        return response()->json(
            $raw_products
        );

        // dd($raw_products);
    }

    public function StockInRawProduct2($item_id, $raw_product_id)
    {
        $item = Item::findOrFail($item_id);
        $raw = Raw::findOrFail($item->raw->id);
        $raw_products = $raw->raw_products;
        $raw_products->map(function ($row) {
            return $row->item = $row->item;
        });
        $selected_raw_product = Raw_product::findORFail($raw_product_id);
        return response()->json(
            $selected_raw_product
        );
        dd($selected_raw_product);
    }

    public function createItemSave(Request $request)
    {

        // item
        DB::transaction(function () use ($request) {
            $item               = new Item;
            $item->item_type_id = $request->input('itemTypeId');
            $item->category_id  = $request->input('category');
            $item->unit_id      = $request->input('unit');
            $item->description  = $request->input('description');
            $item->user_id      = Auth::user()->id;
            if ($request->input('itemTypeId') ==  1) {
                //SaveItem
                $item->save();
                //Raw
                $raw          = new Raw;
                $raw->value   = $request->input('rawValue');
                $raw->item_id = $item->id;
                $raw->save();
                broadcast(new ItemsEvent($item->id));
            } elseif ($request->input('itemTypeId') ==  2) {

                //SaveItem
                $item->save();
                // Raw Product
                $rawProduct          = new Raw_product;
                $rawProduct->value   = $request->input('rawProductValue');
                $rawProduct->raw_id  = $request->input('selectedRaw');
                $rawProduct->item_id = $item->id;
                $rawProduct->save();
                broadcast(new ItemsEvent($item->id));
            } elseif ($request->input('itemTypeId') ==  3) {
                //SaveItem
                $item->save();
                //Not Raw
                $not_raw          = new Not_raw;
                $not_raw->item_id = $item->id;
                $not_raw->save();
                broadcast(new ItemsEvent($item->id));
            }
        });
    }

    public function deleteItem($id)
    {
        $item =  Item::find($id);
        $itemType =  $item->item_type_id;
        DB::transaction(function () use ($itemType, $item) {
            if ($itemType == 1) {
                $raw_id = $item->raw->id;
                Raw::destroy($raw_id);
                $item->delete();
                broadcast(new ItemsEvent($item->id));
            } elseif ($itemType == 2) {
                $raw_product_id = $item->raw_product->id;
                Raw_product::destroy($raw_product_id);
                $item->delete();
                broadcast(new ItemsEvent($item->id));
            } elseif ($itemType == 3) {
                $not_raw_id = $item->not_raw->id;
                Not_raw::destroy($not_raw_id);
                $item->delete();
                broadcast(new ItemsEvent($item->id));
            }
        });
    }

    public function updateItem(Request $request)
    {

        DB::transaction(function () use ($request) {

            $id                = $request->input('id');
            $item              = Item::find($id);
            $item->category_id = $request->input('category');
            $item->unit_id     = $request->input('unit');
            $item->description = $request->input('description');

            if ($item->item_type_id ==  1) {
                $item->raw->value = $request->input('rawValue');
                $item->save();
                $item->raw->save();
                broadcast(new ItemsEvent($item->id));
            } elseif ($item->item_type_id ==  2) {
                $item->raw_product->value  = $request->input('rawProductValue');
                $item->raw_product->raw_id = $request->input('selectedRaw');
                $item->save();
                $item->raw_product->save();
                broadcast(new ItemsEvent($item->id));
            } elseif ($item->item_type_id ==  3) {
                $item->save();
                broadcast(new ItemsEvent($item->id));
            }
        });
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

    public function  AdditionalItem(Request $request)
    {
        DB::transaction(function () use ($request) {
            $value        = $request->input('value');
            $date         = $request->input('date');
            $item         = Item::findOrFail($request->input('itemId'));
            $add          = new Additional;
            $add->item_id = $item->id;
            $add->value   = $value;
            $add->user    = Auth::id();
            $add->date    = $date;
            $add->save();
            broadcast(new ItemsEvent($item->id));
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








    public function index()
    {
        $request = request();

        /*
         $additionals_data = Additional::select('item_id', DB::raw('SUM(value) as addi'))
            ->groupBy('item_id');
         // $query = Item::joinSub($additionals_data, 'additionals', function ($join) {
         //     $join->on('items.id', '=', 'additionals.item_id');
         // })->newQuery();
         // $query = $query->paginate(2);
         // return response()->json(
         //     $query
         // );
        */

        $additionals_data = Additional::select('item_id', DB::raw('SUM(value) as addi'))
            ->groupBy('item_id');

        $in_record_data = In_record::select('item_id', DB::raw('SUM(value) as item_in'))
            ->groupBy('item_id');

        $out_record_data = Out_record::select('item_id', DB::raw('SUM(value) as item_out'))
            ->groupBy('item_id');
        $balance =
            Item::leftJoinSub($additionals_data, 'additionals', function ($join) {
                $join->on('items.id', '=', 'additionals.item_id');
            })
            ->leftJoinSub($in_record_data, 'in_records', function ($join) {
                $join->on('items.id', '=', 'in_records.item_id');
            })
            ->leftJoinSub($out_record_data, 'out_records', function ($join) {
                $join->on('items.id', '=', 'out_records.item_id');
            })
            ->select(
                'items.id as balance_item_id',
                'addi',
                'item_in',
                'item_out',
                DB::raw('IFNULL((( IFNULL(addi,0) + IFNULL(item_in,0) ) - IFNULL(item_out,0)),0) as balance')
            )->newQuery();

        $query = Item::join('units', 'items.unit_id', 'units.id')
            ->join('users', 'items.user_id', 'users.id')
            ->join('categories', 'items.category_id', 'categories.id')
            ->join('item_types', 'items.item_type_id', 'item_types.id')
            // ->leftJoinSub($additionals_data, 'additionals', function ($join) {
            //     $join->on('items.id', '=', 'additionals.item_id');
            // })
            // ->leftJoinSub($in_record_data, 'in_records', function ($join) {
            //     $join->on('items.id', '=', 'in_records.item_id');
            // })
            // ->leftJoinSub($out_record_data, 'out_records', function ($join) {
            //     $join->on('items.id', '=', 'out_records.item_id');
            // })
            ->leftJoinSub($balance, 'balance', function ($join) {
                $join->on('items.id', '=', 'balance.balance_item_id');
            })
            ->select(
                'items.id AS id',
                'items.description AS description',
                'items.created_at AS created',
                'users.name AS created_by',
                'categories.description AS category',
                'item_types.description AS item_type',
                'units.description AS unit',
                'items.category_id',
                'items.item_type_id',
                'items.unit_id',
                'addi',
                'item_in',
                'item_out',
                'balance'
            )
            ->newQuery();

        // $query =
        //     items_view::join('users', 'items_views.user_id', 'users.id')
        //     ->select(
        //         'items_views.id',
        //         'items_views.description',
        //         'items_views.category',
        //         'items_views.item_type',
        //         'items_views.unit',
        //         'items_views.created_at AS created',
        //         'items_views.balance',
        //         'users.name AS created_by',
        //         'items_views.category_id',
        //         'items_views.item_type_id',
        //         'items_views.unit_id'
        //     )->newQuery();

        if (request('sort') != "") {
            // handle multisort
            $sorts = explode(',', request()->sort);
            foreach ($sorts as $sort) {
                list($sortCol, $sortDir) = explode('|', $sort);
                $query = $query->orderBy($sortCol, $sortDir);
            }
        } else {
            $query = $query->orderBy('items.id', 'asc');
        }


        if ($request->exists('filter')) {
            $query->where(function ($q) use ($request) {
                $value = "%{$request->filter}%";
                $q->select(DB::raw('IFNULL(( ( IFNULL(addi,0) + IFNULL(item_in,0) )- IFNULL(item_out,0)),0) as balance'))
                    ->where('items.id', 'like', $value)
                    ->orWhere('items.description', 'like', $value)
                    ->orWhere('categories.description', 'like', $value)
                    ->orWhere('units.description', 'like', $value)
                    ->orWhere('users.name', 'like', $value)
                    ->orWhere('balance', 'like', $value);
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



    //End
}
