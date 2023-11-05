<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $sortBy = $request->sort_by ?? null;

      $products = Product::select('*');

      $products->when($sortBy == 'az', function ($q) {
          return $q->orderBy('name', 'ASC');
      });
      $products->when($sortBy == 'za', function ($q) {
          return $q->orderBy('name', 'DESC');
      });
      $products->when($sortBy == 'low-high', function ($q) {
          return $q->orderBy('our_price', 'ASC');
      });
      $products->when($sortBy == 'high-low', function ($q) {
          return $q->orderBy('our_price', 'DESC');
      });

      $products = $products->paginate(6);

      if ($request->ajax()) {
        return response()->json(['view' => view('products.product-list',compact('products'))->render()]);
      }
  
      return view('products.index', compact('products'));
    }

    /**
     * Add products to the cart
     *
     * @return \Illuminate\Http\Response
     */
    public function addCartItem(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Default to 1 if not provided.

        // Retrieve the current cart from the session.
        $cart = session('cart');

        // Check if the product already exists in the cart.
        if (isset($cart[$productId])) {
            // Update the quantity of the existing product.
            $cart[$productId]++;
        } else {
            // Add a new product to the cart.
            $cart[$productId] = (int)$quantity;
        }

        // Store the updated cart in the session.
        session(['cart' => $cart]);

        $sessionData = session('cart');
        // dd($sessionData);

        return true;
    }

    /**
     * Show cart data to user
     *
     * @return \Illuminate\Http\Response
     */
    public function showCart(){
      $cart = session('cart');
      if(!is_null($cart) && count($cart) > 0){
        $keys = array_filter(array_keys($cart), function ($value) {
            // Remove empty values (including '', null, and false)
            return $value !== '' && $value !== null && $value !== false;
        });

        $products = Product::whereIn('id', $keys)->get();
        $quantity = array_values($cart);

      }else{
        $keys = [];
        $products = [];
        $quantity = [];
        $cart = 0;
      }

      return view('products.cart',compact('cart','products','quantity','keys'));
    }

    /**
     * update quantity in cart
     *
     * @return \Illuminate\Http\Response
     */
    public function updateCartItem(Request $request)
    {
        $productId = $request->input('product_id');
        $type = $request->input('type');

        // Retrieve the current cart from the session.
        $cart = session('cart');

        if($type == 'plus'){       

          if (isset($cart[$productId])) {
              // Increment the quantity of the product.
              $quantity = $cart[$productId];
              $cart[$productId] =  $quantity + 1;
          }

        }else{
          if (isset($cart[$productId])) {
              // Decrement the quantity of the product.
             $quantity = $cart[$productId];
              $cart[$productId] = $quantity - 1;
          }         
        }
        // Store the updated cart in the session.
        session(['cart' => $cart]);


        //get session data from cart
        $cart = session('cart');
// dd($cart,$productId);
        $product = Product::where('id', $productId)->first();
        $productQuantity = $cart[$productId];
        $productPrice = round($cart[$productId] * $product->our_price,2);
        $totalPrice = 0;

        foreach ($cart as $productId => $quantity) {
            $totalPrice += round(Product::where('id', $productId)->first()->our_price * $quantity,2);
        }
        return response()->json([
            'success' => true,
            'productQuantity' => $productQuantity,
            'productPrice' => $productPrice,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * delete product from cart
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteCartItem(Request $request)
    {
        $productId = $request->input('product_id');

        // Retrieve the current cart from the session.
        $cart = session('cart');

        // Check if the product exists in the cart.
        if (isset($cart[$productId])) {
            // Remove the product from the cart.
            unset($cart[$productId]);
            session(['cart' => $cart]);
        }

        //get session data from cart
        $cart = session('cart');
        $totalCount = count($cart);
        $totalPrice = 0;

        foreach ($cart as $productId => $quantity) {
            $totalPrice += round(Product::where('id', $productId)->first()->our_price * $quantity,2);
        }
        return response()->json([
            'success' => true,
            'totalPrice' => $totalPrice,
            'totalCount' => $totalCount,
        ]);

    }

}
