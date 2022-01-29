<?php

namespace App\Http\Controllers\API\Frontend\Cart;

use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\Cart\CartResource;
use App\Models\Cart\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $cartItems = Cart::where('customer_id', Auth::id())->get();
        $count = 0;
        foreach($cartItems as $item){
            $count += $item->quantity;
            // return response()->json($item->count());
        }
        $cartCount['count']= $count;
        $cartCount['status']= true;
        return response()->json($cartCount);
    }
    public function get_cart_items()
    {
        $cartItems = Cart::with('product', 'product.image')->where('customer_id', Auth::user()->id)->get();
        return CartResource::collection($cartItems);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['customer_id'] = Auth::user()->id;
        $data['quantity'] = 1;
        $count = Cart::where('customer_id', Auth::user()->id)->where('product_id', $request->product_id)->count();
        if ($count > 0){
          $cart_data = Cart::where('customer_id', Auth::user()->id)->where('product_id', $request->product_id)->first();
          $update_data['quantity'] =  $cart_data->quantity + 1;
          $cart_data->update($update_data);

        }else{
            Cart::create($data);
        }
        return response()->json([
            'status'  => 'success',
            'message' => 'Product Added to Cart Successfully!',
            'icon'    => 'check',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        $cart = Cart::findOrFail($id);
        $cart->update($request->all());
        return response()->json([
            'status'  => 'success',
            'message' => 'Quantity Updated Successfully!',
            'icon'    => 'check',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return response()->json([
            'status'  => 'success',
            'message' => 'Cart Removed Successfully!',
            'icon'    => 'check',
        ]);
    }
}
