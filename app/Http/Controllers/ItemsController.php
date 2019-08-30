<?php

namespace App\Http\Controllers;

use App\Category;
use App\Events\ItemsEvent;

use Illuminate\Http\Request;
use App\Item;
use App\Item_type;
use App\Not_raw;
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
        $item->selected_unit = $item->unit;
        $categories = Category::all();
        $units = Unit::all();
        $raws = Raw::all();
        if ($item->item_type_id == 1) {
            $data = array(
                "item" =>  $item,
                "categories" => $categories,
                "units" =>  $units,
                "raw_value" =>  $item->raw->value
            );
        } elseif ($item->item_type_id == 2) {
            if ($raws->isNotEmpty()) {
                $raws->map(function ($row) {
                    return $row->item = $row->item;
                });
            }
            $selectedRaw = $raws->firstWhere('id', $item->raw_product->raw_id);
            $data = array(
                "item" =>  $item,
                "categories" => $categories,
                "units" =>  $units,
                "raws" =>  $raws,
                "raw_product_value" =>  $item->raw_product->value,
                "selected_raw" =>    $selectedRaw

            );
        } elseif ($item->item_type_id == 3) {
            $data = array(
                "item" =>  $item,
                "categories" => $categories,
                "units" =>  $units
            );
        }

        return response()->json($data);
    }




    public function createItem($id)
    {
        if (!($id >= 1 && $id <= 3)) {
            return view('app.pages.items.items');
        }
        $itemType = Item_type::find($id);
        $categories = Category::all();
        $units = Unit::all();
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

    public function createItemSave(Request $request)
    {

        // item
        DB::transaction(function () use ($request) {
            $item = new Item;
            $item->item_type_id = $request->input('itemTypeId');
            $item->category_id = $request->input('category');
            $item->unit_id = $request->input('unit');
            $item->description = $request->input('description');
            $item->user_id = Auth::user()->id;
            if ($request->input('itemTypeId') ==  1) {
                //SaveItem
                $item->save();
                //Raw
                $raw = new Raw;
                $raw->value = $request->input('rawValue');
                $raw->item_id = $item->id;
                $raw->save();
            } elseif ($request->input('itemTypeId') ==  2) {
                //SaveItem
                $item->save();
                // Raw Product
                $rawProduct = new Raw_product;
                $rawProduct->value = $request->input('rawProductValue');
                $rawProduct->raw_id = $request->input('selectedRaw');
                $rawProduct->item_id = $item->id;
                $rawProduct->save();
            } elseif ($request->input('itemTypeId') ==  3) {
                //SaveItem
                $item->save();
                //Not Raw
                $not_raw = new Not_raw;
                $not_raw->item_id = $item->id;
                $not_raw->save();
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
            } elseif ($itemType == 2) {
                $raw_product_id = $item->raw_product->id;
                Raw_product::destroy($raw_product_id);
                $item->delete();
            } elseif ($itemType == 3) {
                $not_raw_id = $item->not_raw->id;
                Not_raw::destroy($not_raw_id);
                $item->delete();
            }
        });
    }

    public function updateItem(Request $request)
    {

        DB::transaction(function () use ($request) {

            $id = $request->input('id');
            $item = Item::find($id);
            $item->category_id = $request->input('category');
            $item->unit_id = $request->input('unit');
            $item->description = $request->input('description');

            if ($item->item_type_id ==  1) {
                $item->raw->value = $request->input('rawValue');
                $item->save();
                $item->raw->save();
            } elseif ($item->item_type_id ==  2) {
                $item->raw_product->value = $request->input('rawProductValue');
                $item->raw_product->raw_id = $request->input('selectedRaw');
                $item->save();
                $item->raw_product->save();
            } elseif ($item->item_type_id ==  3) {
                $item->save();
            }
        });
    }






    public function index()
    {
        $request = request();
        $query = Item::join('units', 'items.unit_id', 'units.id')
            ->join('users', 'items.user_id', 'users.id')
            ->join('categories', 'items.category_id', 'categories.id')
            ->join('item_types', 'items.item_type_id', 'item_types.id')
            ->select(
                'items.id AS id',
                'items.description AS description',
                'items.remove AS remove',
                'items.created_at AS created',
                'users.name AS created_by',
                'categories.description AS category',
                'item_types.description AS item_type',
                'units.description AS unit',
                'items.category_id',
                'items.item_type_id',
                'items.unit_id'
            )
            ->newQuery();
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
                $q->where('items.id', 'like', $value)
                    ->orWhere('items.description', 'like', $value)
                    ->orWhere('categories.description', 'like', $value)
                    ->orWhere('item_types.description', 'like', $value)
                    ->orWhere('users.name', 'like', $value);
            });
        }


        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $pagination = $query->paginate($perPage);
        $pagination->appends([
            'sort' => request()->sort,
            'filter' => request()->filter,
            'per_page' => request()->per_page
        ]);

        //   dd($pagination);


        return response()->json(
            $pagination
        )
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }
}
