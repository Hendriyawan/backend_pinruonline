<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FasilitasController extends Controller
{

    /**
     * @param Request request
     */
    public function createFasilitas(Request $request){
        $user = User::find(idApi());
        $validator = Validator::make($request->all(), [
            'kode_fasilitas' => 'required',
            'nama_fasilitas' => 'required',
            'status_fasilitas' => 'required',
            'keterangan' => 'required'
        ]);
        
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'harap isi semua form'
            ], 200);
        }

        if($user->role == 'admin'){
            $fasilitas = Fasilitas::create([
                'kode_fasilitas' => $request->kode_fasilitas,
                'nama_fasilitas' => $request->nama_fasilitas,
                'status_fasilitas' => $request->status_fasilitas,
                'keterangan' => $request->keterangan,
                'image' => $request->image
            ]);

            return response()->json([
                'success' => true,
                'message' => 'fasilitas success create'
            ], 200);
        }
    }


    /**
     * update fasilitas
     */
    public function editFasilitas(Request $request){
        $fasilitas = Fasilitas::find($request->id);
        $fasilitas->kode_fasilitas = $request->kode_fasilitas;
        $fasilitas->nama_fasilitas = $request->nama_fasilitas;
        $fasilitas->status_fasilitas = $request->status_fasilitas;
        $fasilitas->keterangan = $request->keterangan;
        $fasilitas->image = $request->image;
        $fasilitas->save();
        if($fasilitas){
            return response()->json([
                'success' => true,
                'message' => 'fasilitas success updated !'
            ], 200);
        }
    }

    /**
     * load a fasilitas feature
     */
    public function loadFasilitas(){
        $fasilitas = Fasilitas::orderBy('id', 'ASC')->get();
        return response()->json([
            'success' => true,
            'fasilitas' => $fasilitas
        ], 200);
    }

    //delete fasilitas
    public function deleteFasilitas(Request $request){
        $fasilitas = Fasilitas::where('id', $request->id)->delete();
        if($fasilitas){
            return response()->json([
                'success' => true,
                'message' => 'delete fasilitas success.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'delete fasilitas failed'
            ], 200);
        }
    }

    /**
     * upload image 
     */
    public function uploadImage(Request $request){
        $ip = $request->root();
        if($request->file('image')){
            $file = $request->file('image');
            $filename = time().'_'.$request->file('image')->getClientOriginalName();
            $filePath = public_path() . '/files/uploads/images';
            $file->move($filePath, $filename);
            return response()->json([
                'success' => true,
                'message' => 'image success upload',
                'url' => $ip.'/files/upload/images/'.$filename
            ], 200);

        }
    }
}
