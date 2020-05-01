<?php

namespace App\Http\Controllers;

use App\CustomizeClass\ItemClass;
use App\Delivery;
use App\Delivery_list;
use App\Events\NotificationEvent;
use App\Item;
use App\Notification;
use App\request as AppRequest;
use App\request_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class DeliveriesController extends Controller
{
    public function getProducts()
    {

        $items = Item::all()->where("item_type_id", "<>", "1");
        $result = array();
        if ($items->isNotEmpty()) {

            foreach ($items as $key => $row) {
                $row->balance =  ItemClass::getItemBalance($row->id);
                $row->unit_desc = $row->unit->description;
                $row->selected = "false";
                array_push($result, $row);
            }
            // $items->map(function ($row) {
            //     $row->balance =  ItemClass::getItemBalance($row->id);
            //     $row->unit_desc = $row->unit->description;
            //     $row->selected = "false";
            //     return $row;
            // });
        }

        return response()->json($result);
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
            $req->user_id = Auth::user()->id;
            $req->save();
            foreach ($products as $key => $product) {
                $request_list = new request_list;
                $request_list->request_id = $req->id;
                $request_list->item_id = $product['id'];
                $request_list->quantity = $product['quantity'];
                $request_list->save();
            }

            $notif = new Notification;
            $notif->title = 'New Delivery Request';
            $notif->notification_type_id = 2;
            $notif->request_id = $req->id;
            $notif->user_id = Auth::user()->id;
            $notif->save();

            $data = Notification::CountUnseen();
            broadcast(new NotificationEvent($data));


        });
    }

    public function sendDelivery(Request $request)
    {
        DB::transaction(function () use ($request) {
            $products = $request->input('products');
            $req = new AppRequest;
            $delivery = new Delivery;
            $delivery->branch = $request->input('branch');
            $delivery->user_id = Auth::user()->id;
            $delivery->save();
            foreach ($products as $key => $product) {
                $list = new Delivery_list;
                $list->delivery_id = $delivery->id;
                $list->item_id = $product['id'];
                $list->quantity = $product['quantity'];
                $list->save();
            }

            // $notif = new Notification;
            // $notif->notification_type_id = 2;
            // $notif->

        });
    }
}
