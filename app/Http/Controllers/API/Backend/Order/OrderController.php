<?php

namespace App\Http\Controllers\API\Backend\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\Backend\Order\OrderResource;
use App\Models\Order\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $dataSorting = $request->sorting == 'false'?10:$request->sorting;
        $data =$search == 'false'?Order::orderBy('id', 'desc')->paginate($dataSorting):Order::where(function($query) use($search){
            $query->orWhere('name', 'LIKE', "%{$search}%")
            ->orWhere('doctor_id', 'LIKE', "%{$search}%")
            ->orWhere('mobile_no', 'LIKE', "%{$search}%")
            ->orWhere('address', 'LIKE', "%{$search}%")
            ->orWhere('birth_day', 'LIKE', "%{$search}%")
            ->orWhere('m_day', 'LIKE', "%{$search}%");
        })->orderBy('id', 'desc')->paginate($dataSorting);
        return OrderResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $Order = Order::insert($request->all());
       
        if ($Order){
            return response()->json([
                'status' => 'success',
                'message' => 'Order has been created!'
            ]);
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
        $order = Order::findOrFail($id);
        return   new OrderResource($order);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        $Order = Order::findOrFail($id)->update($request->all());
       
        if ($Order){
            return response()->json([
                'status' => 'success',
                'message' => 'Order has been updated!'
            ]);
        }

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Order::find($id)->delete();
        if($delete){
            return response()->json([
                'status'  => 'danger',
                'message' => 'Order has been deleted!',
                'icon'    => 'times',
            ]);   
        }
       
    }
}
