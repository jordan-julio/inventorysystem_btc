<?php

namespace App\Http\Controllers;

use App\Material;
use App\MaterialH;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = MaterialH::paginate(25);

        return view('inventory.material.home', compact('materials'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('inventory.material.createnew');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProductRequest  $request
     * @param  App\Product  $model
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MaterialH $model)
    {
        $model->create($request->all());

        return redirect()
            ->route('inventory.material.home')
            ->withStatus('Material successfully registered.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialH $material)
    {

        return view('inventory.material.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialH $material)
    {
        $material->update($request->all());

        return redirect()
            ->route('inventory.material.home')
            ->withStatus('Material updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialH $material)
    {
        $material->delete();

        return redirect()
            ->route('inventory.material.home')
            ->withStatus('Material removed successfully.');
    }
}
