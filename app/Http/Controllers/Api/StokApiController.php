<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Response;
use App\Http\Controllers\Controller;
use App\Models\Stok;

class StokApiController extends Controller
{
    public function getAllStok(){
    	$stokresult = Stok::All();

  //   	return response()->json([
		//     array('res' => true, 'data' => $stokresult)
		// ]);

    	return response()->json([
    		'data' => $stokresult,
    		'res' => true,
    		],200);

    }

    public function getStok($id){
    	
    	// $namabarang = $request->input('id');

    	$stokresult = Stok::where('id', $id);

    	return Response::json(array(array(
    		'res' => true,
    		'data' => $stokresult,
    	)), 200);

    	// return $namabarang;
    }

    public function getStokItem(Request $request){
    	$id =  $request->input('id');

    	$stokresult = Stok::where('id', $id)->get();

  //   	return response()->json([
		//     array('res' => true, 'data' => $stokresult)
		// ]);

    	if($stokresult){
            return response()->json([
            'data' => $stokresult,
            'res' => true,
            ],200);
        }else{
            return response()->json([
                'res'=> false ]);
        }
    }
}
