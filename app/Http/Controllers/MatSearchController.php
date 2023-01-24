<?php
 
namespace App\Http\Controllers;
 

use Illuminate\Support\Facades\DB;
use App\MaterialU;
use App\MaterialH;
use Carbon\Carbon;
use App\UsedMaterial;
use Illuminate\Http\Request; 
 
class MatSearchController extends Controller
{
	public function index()
	{
    		// mengambil data dari table pegawai
            $materials = MaterialU::latest()->paginate(10);
 
    		// mengirim data pegawai ke view index
		return view('inventory.material.matsearch',['materials' => $materials]);
 
	}
 
	public function cari(Request $request)
	{
		// menangkap data pencarian
		$cari = $request->cari;
 
    		// mengambil data dari table pegawai sesuai pencarian data
		$materials = MaterialU::
		where('DateAdded','like',"%".$cari."%")
		->paginate();
 
    		// mengirim data pegawai ke view index
		return view('inventory.material.matsearch',['materials' => $materials]);
 
	}
 
}