<?php

namespace App\Http\Controllers;

use App\MaterialU;
use App\MaterialH;
use App\Product;
use Carbon\Carbon;
use App\UsedMaterial;
use Illuminate\Http\Request;

class MaterialUseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = MaterialU::latest()->paginate(25);

        return view('inventory.material.materialuse', compact('materials'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('inventory.material.createuse', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MaterialU $model)
    {
        $materialused = $model->create($request->all());
        
        return redirect()
            ->route('materialused.show', ['materialused' => $materialused->id])
            ->withStatus('Pot registered successfully, you can start inserting materials.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialU $materialused)
    {
        return view('inventory.material.show', ['materialused' => $materialused]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialU $materialused)
    {
        $materialused->delete();

        return redirect()
            ->route('materialused.index')
            ->withStatus('The pot has been successfully deleted.');
    }
    public function addproduct(MaterialU $materialused)
    {
        $materials = MaterialH::all();

        return view('inventory.material.addproduct', compact('materialused', 'materials'));
    }

    public function storeproduct(Request $request, MaterialU $materialused, UsedMaterial $usedmaterial)
    {
        $usedmaterial->create($request->all());
        
        UsedMaterial::join('material_h_s', 'material_h_s.id', '=', 'used_materials.mat_id')->where('used_materials.mat_id',Request('mat_id'))
        ->decrement('material_h_s.TotalmatAmount', Request('qty'));
        
        return redirect()
            ->route('materialused.show', ['materialused' => $materialused])
            ->withStatus('Material successfully registered.');
    }

    public function editproduct(MaterialU $materialused, UsedMaterial $usedmaterial)
    {
        $materials = MaterialH::all();

        return view('inventory.material.editproduct', compact('materialused', 'usedmaterial', 'materials'));
    }

    public function updateproduct(Request $request, MaterialU $materialused, UsedMaterial $usedmaterial)
    {
        $usedmaterial->update($request->all());

        return redirect()->route('inventory.material.show', $materialused)->withStatus('Material successfully modified.');
    }

    public function destroyproduct(Request $request, MaterialU $materialused, UsedMaterial $usedmaterial)
    {
        $usedmaterial->delete();

        return back()->withStatus('The material has been disposed of successfully.');
    }
}
