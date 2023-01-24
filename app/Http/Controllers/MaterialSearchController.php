<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Material;
use App\MaterialH;

class MaterialSearchController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $materials = MaterialH::all();
      return view('inventory.material.create', compact('materials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProductRequest  $request
     * @param  App\Product  $model
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Material $model)
    {
        $model->create($request->all());
        Material::join('material_h_s', 'material_h_s.id', '=', 'materials.material_id')
        ->where('materials.material_id',Request('material_id'))
        ->increment('material_h_s.TotalmatAmount', Request('matAmount'));
        Material::join('material_h_s', 'material_h_s.id', '=', 'materials.material_id')
        ->where('materials.material_id',Request('material_id'))
        ->increment('material_h_s.TotalmatDefect', Request('matDefect'));
        return redirect()
            ->route('inventory.material.index')
            ->withStatus('Material successfully registered.');
    }
    public function index()
    {
     $materials = Material::get();
     return view('inventory.material.index',compact('materials'));
    }
    public function action(Request $request)
    {
      
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
        $data = DB::table('materials')->join('material_h_s', 'materials.material_id', '=', 'material_h_s.id')
          ->select('material_h_s.material','materials.matAmount','materials.matDefect', 'materials.price', 'materials.DateAdded')
          ->where('DateAdded', 'like', '%'.$query.'%')
          ->orderBy('materials.id', 'desc')
          ->get();
        $total_amount = DB::table('materials')->join('material_h_s', 'materials.material_id', '=', 'material_h_s.id')
        ->select('materials.price')
        ->where('DateAdded', 'like', '%'.$query.'%')
        ->orderBy('materials.id', 'desc')
        ->sum('materials.price');
         
      }
      else
      {
       $data = DB::table('materials')->join('material_h_s', 'materials.material_id', '=', 'material_h_s.id')
       ->select('material_h_s.material','materials.matAmount','materials.matDefect', 'materials.price', 'materials.DateAdded')
         ->orderBy('materials.id', 'desc')
         ->get();
         $total_amount = DB::table('materials')->join('material_h_s', 'materials.material_id', '=', 'material_h_s.id')
        ->select('materials.price')
        ->orderBy('materials.id', 'desc')
        ->sum('materials.price');
      }
      $total_row = $data->count();
      $amount = $total_amount;
      if($total_row > 0)
      {
        
       foreach($data as $row)
       {
        $output .= '
        <tr>
          <td>'.$row->material.'</td>
          <td>'.$row->matAmount.' kg</td>
          <td>'.format_money($row->price).'</td>
          <td>'.$row->DateAdded.'</td>  
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Materials Purchased on this Date</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row,
       'total'=> format_money($amount),
      );

      echo json_encode($data);
     }
    }
}
