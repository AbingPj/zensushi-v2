<?php

namespace App\Http\Controllers;

use App\CustomizeClass\ItemClass;
use App\Item;
use App\request as AppRequest;
use App\request_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveriesController extends Controller
{
    public function getProducts()
    {

        $items = Item::all()->where("item_type_id", "<>", "1");
        if ($items->isNotEmpty()) {
            $items->map(function ($row) {
                $row->balance =  ItemClass::getItemBalance($row->id);
                $row->unit_desc = $row->unit->description;
                $row->selected = "false";
                return $row;
            });
        }
        return response()->json($items);
    }

    public function serchProducts($product)
    {
        $prod = $product;
        // $items = Item::whereRaw("item_type_id <> 1 AND (description LIKE '%" . $prod . "%' OR id LIKE '%" . $prod . "')")->get();
        $items = Item::where('item_type_id', '<>', 1)
            ->where(function ($query) use ($prod) {
                return $query->where("description", "LIKE", "%$prod%")
                    ->orWhere("id", "like", "%$prod%");
            })
            ->get();

        if ($items->isNotEmpty()) {
            $items->map(function ($row) {
                $row->balance =  ItemClass::getItemBalance($row->id);
                $row->unit_desc = $row->unit->description;
                $row->selected = "false";
                return $row;
            });
        }
        return response()->json($items);
    }

    public function sendDeliveryRequest(Request $request)
    {
        DB::transaction(function () use ($request) {
            $products = $request->input('products');
            $req = new AppRequest;
            $req->branch = $request->input('branch');
            $req->save();
            foreach ($products as $key => $product) {
                $request_list = new request_list;
                $request_list->request_id = $req->id;
                $request_list->item_id = $product['id'];
                $request_list->quantity = $product['quantity'];
                $request_list->save();
            }
        });
    }

    public function sendDelivery(Request $request)
    {
        $branch = $request->input('branch');
        $products = $request->input('products');

      



        dd($request);
    }
}
