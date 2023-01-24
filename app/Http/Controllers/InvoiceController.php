<?php

namespace App\Http\Controllers;
use App\Product;
use App\ProductAdd;
use App\Sale;
use App\SoldProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::orderBy('created_at', 'desc')->get();
        return view('invoice.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInvoice(Request $request)
    {
        $sales = Sale::orderBy('created_at', 'desc')->get();
        $saleId = $request->get('sale_id');
        $ppn = $request->get('ppn');
        $discount = $request->get('discount');
        $sale = Sale::where('id', $saleId)->first();
        $productSold = SoldProduct::where('sale_id', $sale->id)->get();
        
        $totalAmount = 0;
        if ($productSold->count() != 0) {
            foreach($productSold as $sold) {
                $totalAmount += $sold->price * $sold->qty;
            }
            $discountamount = 0;
            $initialTotal = format_money_int($totalAmount);
            if ($discount != 0) {
                $discountamount = ($discount / 100) * $totalAmount;
                $totalAmount = $totalAmount - $discountamount;
                $discountamount = format_money_int($discountamount);
            }
            $ppnAmount = ($totalAmount * ($ppn / 100));
            $finalRes = ($totalAmount + $ppnAmount);

            $ppnAmount = format_money_int($ppnAmount);
            $totalAmount = format_money_int($totalAmount);
            $finalRes = format_money_int($finalRes);
            return view('invoice.confirmForm', compact('initialTotal', 'discountamount', 'discount', 'sale', 'ppn', 'ppnAmount', 'finalRes', 'totalAmount'));
        }
        return redirect()
        ->route('invoice.index', compact('sales'))
        ->withStatus('Tidak Ada Product Di Order Id');
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
    public function show()
    {
        return view('');
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
