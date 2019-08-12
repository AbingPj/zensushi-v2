<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Item_type;

class ItemsController extends Controller
{
    public function items(){
        $items = Item::all();
        return response()->json($items);
    }

    public function item_types(){
        $items = Item_type::all();
        return response()->json($items);   
    }

    public function createItem($id){
       
        $item = Item_type::find($id);
        return view('app.pages.items.items-create', compact($item));
       
    }

    public function index()
    {
        $request = request();
        $query = Item::join('units','items.unit_id','units.id')
                     ->join('users', 'items.user_id','users.id')
                     ->join('categories','items.category_id','categories.id')
                     ->join('item_types', 'items.item_type_id','item_types.id')
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
            if (request('sort') != "" ){
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
                 $query->where(function($q) use($request) {
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
