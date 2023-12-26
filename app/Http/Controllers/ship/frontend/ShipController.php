<?php

namespace App\Http\Controllers\ship\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class ShipController extends Controller
{

    public function getPriceShip(Request $request)
    {

        $data = getFeeShip($request->cityID, $request->districtID);
        echo json_encode($data);
        die;
        //end

    }
    public function changePriceShip(Request $request)
    {
        $fee_shipping = !empty($request->fee) ? $request->fee : 0;
        $total = $price_coupon = 0;
        $cartController = Session::get('cart');
        $coupon = Session::get('coupon');
        if ($cartController) {
            foreach ($cartController as $k => $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }
        if (isset($coupon)) {
            foreach ($coupon as $item) {
                $price_coupon += !empty($item['price']) ? $item['price'] : 0;
            }
        }
        return response()->json(['totalCart' => $total + $fee_shipping - $price_coupon, 'fee_shipping' => $fee_shipping]);
    }

    public function getShipInfor(Request $request)
    {
        $param = $request->param;
        $detail = [];
        $alert = '';
        $ship = 0;
        if( $param['ship_city'] > 0 ){
            $detail  = \App\Models\VNCity::orderBy('id', 'asc')->find($param['ship_city']);
            $alert = $detail->description;
            $ship = $detail->price;
            $this->addLocation( $param, $detail );
        }
        return response()->json(['alert' => $alert, 'ship' => $ship]);
    }

    public function addLocation( $param, $detail ){

        $shipLocation = Session::get('location');
        $data = [];
        if( $shipLocation == null || isset($param) && is_array($param) && count($param) ){
            $data['cityid'] = $param['ship_city'];
            $data['districtid'] = $param['ship_district'];
            $data['wardid'] = $param['ship_ward'];
            $data['description'] = $detail->description;
            $data['ship'] = $detail->ship;
        }
        Session::put('location', $data);
        Session::save();
    }
}
