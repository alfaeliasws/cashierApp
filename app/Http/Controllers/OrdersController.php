<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function store(Request $request)
    {

        $requestArray = [];

        //looping anchor for data structuring
        $i = 0;
        $requests = 1;

        $waiter = "";
        //looping to create data structure
        foreach ($request->except('_token') as $key => $part) {

            //validation
            if(!$part){ return redirect('/invalid-input');}


            //grouping array
            if(str_contains($key,"order_number")){
                $waiter = substr($part,0,3) ;
            }


            $requestArray[$requests][str_replace($requests,"",$key)] = $part;


            $i++;
            if($i > 4){
                $i = 0;
                $requestArray[$requests]["waiter"] = $waiter;
                $requests++; }
        }

        foreach($requestArray as $singleRequest){
            Order::create($singleRequest);
        }

        $user = Auth::user()->employeeid;
        $activity = $requestArray[1]['order_number'];
        $message = "{$user} order taken identified with this order number: {$activity}";

        logging($user,$message);


        return redirect('/waiter/order-created');

    }

    //show
    public function show($order_number){

        $shown_order = DB::table('orders')->where("order_number",$order_number)->get();

        $user = Auth::user()->employeeid;
        $message = "{$user} viewing this order: {$order_number}";

        logging($user,$message);

        return view('show-waiter',["orders" => $shown_order]);
    }

    //edit show form
    public function edit($order_number){

        $shown_order = Order::where("order_number",$order_number)->get();
        // ->where(function($query) {
        //     $query->where("status","!=","closed"); })->get();


        $menu = Item::where("status","Ready")->get();

        $user = Auth::user()->employeeid;
        $message = "{$user} is editing this order: {$order_number}";

        logging($user,$message);


        return view('waiter-edit',["orders" => $shown_order, "items" => $menu]);
    }

    //update
    public function update(Request $request, $order_number){

        function submitToUpdate($requestArgs, $numberArgs){
            $requestArray = [];

        //looping anchor for data structuring
        $i = 0;
        $requests = 1;

        $check = DB::table('orders')->where("order_number",$numberArgs)->delete();

        //looping to create data structure
        foreach ($requestArgs->except('_token',"_method","submit") as $key => $part) {

            //validation
            if(!$part){ return redirect('/invalid-input');}

            //grouping array
            $requestArray[$requests][preg_replace('/[0-9]+/', '', $key)] = $part;

            $i++;
            if($i > 4){
                $i = 0;
                $requests++; }
        }

            return $requestArray;
        }

        function createData($array, $numberArgs){
            foreach($array as $singleRequest){
                $waiter = substr($numberArgs,0,3);
                $singleRequest["waiter"] = $waiter;

                Order::create($singleRequest);
            }
        }

        function closeTransaction($array, $numberArgs){
            foreach($array as $singleRequest){
                $waiter = substr($numberArgs,0,3);

                $singleRequest["status"] = "closed";
                $singleRequest["waiter"] = $waiter;
                $singleRequest["cashier"] = Auth::user()->employeeid;

                Order::create($singleRequest);
            }
        }

        if($request->submit === "update"){
            $requestArray = submitToUpdate($request, $order_number);

            createData($requestArray,$order_number);

            $user = Auth::user()->employeeid;
            $message = "{$user} is updating this order: {$order_number}";

            logging($user,$message);

            return redirect('/waiter/order-created');
        }

        if($request->submit === "close"){

            $requestArray = submitToUpdate($request, $order_number);

            closeTransaction($requestArray,$order_number);

            $user = Auth::user()->employeeid;
            $message = "{$user} is closing this order: {$order_number}";

            logging($user,$message);

            return redirect('/waiter/order-created');
        }

    }
}
