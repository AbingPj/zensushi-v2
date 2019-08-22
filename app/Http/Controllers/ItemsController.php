<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Item;
use App\Item_type;
use App\Raw;
use App\Unit;
use Auth;

class ItemsController extends Controller
{
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
        }

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
            $rawProduct->raw = $request->input('selectedRaw');
            $rawProduct->item_id = $item->id;
            $rawProduct->save();
        }
    }

    public function removeItem($id)
    {
        $item =  Item::find($id);
        dd($item);
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
