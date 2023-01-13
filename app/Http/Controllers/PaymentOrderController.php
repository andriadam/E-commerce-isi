<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request;
        $user = User::find($request->id);
        if ($user) {
            return Order::with('user')->withCount('orderDetail')->whereBelongsTo($user)->paginate(3);
        } else {
            return response()->json([
                'message' => 'There are no orders with this user.'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Cek validasi data
        $validator = Validator::make(request()->all(), [
            'order_id' => 'required',
            'no_rek' => 'required',
            'bank_name' => 'required',
            'transfer_date' => 'required|date_format:Y/m/d',
        ]);
        if ($validator->fails()) {
            response()->json($validator->messages(), 422)->send();
            exit;
        }

        // simpan ke database
        $order = Order::whereId($request->order_id)->update([
            'no_rek' => request('no_rek'),
            'bank_name' => request('bank_name'),
            'transfer_date' => request('transfer_date'),
            'statusPayment' => 'Waiting Confirmation',
        ]);

        if ($order) {
            return response()->json([
                'status' => 'success',
                'message' => 'We have received confirmation of payment, please wait for the next order status.'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Sorry, the order you meant is missing or filled incorrectly.'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
