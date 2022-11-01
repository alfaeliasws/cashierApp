<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    public function home(){
        $orders = Order::latest()->where("status","=","active")->get();

        $shown_orders = [];
        $i = 0;

        $order_number = "";

        foreach($orders as $order){
            if($order_number === "")
            {
                $order_number = $order["order_number"];
                $shown_orders[$order_number][$i] = $order;
                $i++;
                continue;
            }
            if($order_number !== "" && $order_number === $order["order_number"]){
                $shown_orders[$order_number][$i] = $order;
                $i++;
            }
            if($order_number !== "" && $order_number !== $order["order_number"]){
                $order_number = $order["order_number"];
                $shown_orders[$order_number][$i] = $order;
                $i++;
            }
        }

        //logging
        if(Auth::user()){
            $user = Auth::user()->employeeid;
            $message = "{$user} is viewing home";

            logging($user,$message);
        }

        //view
        return view('welcome',["orders" => $shown_orders ]);
    }

    public function waiter(){
        $menu = Item::where("status","Ready")->get();
        $orders = Order::whereDate("created_at", DB::raw('CURDATE()'))->where("status","=","active")->get();

        $user = Auth::user()->employeeid;
        $message = "{$user} is in the dashboard to take order";

        logging($user,$message);

        return view('waiter',["items" => $menu, "orders" => $orders ]);
    }

    public function logs(){

        $user = Auth::user()->employeeid;
        $logs = Log::latest()->where('employeeid',$user)->whereDate("created_at", DB::raw('CURDATE()'))->get();

        $message = "{$user} is viewing his/her logs";

        logging($user,$message);

        return view('logs',["logs" => $logs]);
    }

    public function invalid_input(){
        $user = Auth::user()->employeeid;
        $message = "{$user} is making invalid input";

        logging($user,$message);
        return view('invalid-input');
    }

    public function order_created(){
        return view('order-created');
    }

}
