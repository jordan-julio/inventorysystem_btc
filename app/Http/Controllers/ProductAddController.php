<?php

namespace App\Http\Controllers;
use App\Product;
use App\ProductAdd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProductAddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $products = ProductAdd::join('products', 'products.id', '=', 'product_adds.product_id')->orderBy('product_adds.created_at','desc')->paginate(25);


        return view('inventory.productsadd.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        

        return view('inventory.productsadd.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductAdd $model)
    {
        $products = $model->create($request->all());
        #foreach ($production as $sold_product) {
        #    $sold_product->product->stock = $sold_product->qty;
        #    $sold_product->product->save();
        #}
        ProductAdd::join('products', 'products.id', '=', 'product_adds.product_id')->increment('products.stock', Request('qty'));
        return redirect()
            ->route('productsadd.index')
            ->withStatus('product registered successfully, you can start registering products and transactions.');
            
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductAdd $product)
    {
        return view('inventory.productsadd.show', ['products' => $product]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $userx = Auth::user();
        $id = $userx->id;
        $user = DB::table('users')->select('*')->where('id',$id)->first();
        if (($user->type)=='super_admin'){
            $delete = ProductAdd::select('*')->where('Kode',$product);
            $delete->delete();
            return redirect()
            ->route('productsadd.index')
            ->withStatus('The product has been disposed of successfully.');
            
        }
        #incase of going to index again
        return redirect()
            ->route('productsadd.index');
            

    }

    public function addproduct()
    {
        $product = Product::all();
        return view('inventory.productsadd.addproduct', compact('product'));
    }

    public function destroyproduct($product)
    {
        $delete = ProductAdd::find($product);
        $delete->delete();

        return redirect()
            ->route('productsadd.index')
            ->withStatus('The product has been disposed of successfully.');
    }
}
