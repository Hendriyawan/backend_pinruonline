<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SuratController extends Controller
{
    /**
     * make a loan application form
     * membuat form pengajuan pinjaman
     */
    public function createForm(Request $request){
        $validator = Validator::make($request->all(), [
            'id_user' => 'required',
            'kode_surat' => 'required',
            'tanggal_masuk_surat' => 'required',
            'nomor_surat' => 'required',
            'lampiran' => 'required',
            'perihal' => 'required',
            'nama_kegiatan' => 'required',
            'tanggal_surat' => 'required',
            'waktu' => 'required',
            'tempat' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
            'up_surat' => 'required',
            'lembaga' => 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ], 401);
        }


        $user = User::find(idApi());
        $surat = Surat::create([
            'id_user' => $user->id,
            'username' => $user->username,
            'validator' => '',
            'kode_surat' => $request->kode_surat,
            'tanggal_masuk_surat' => $request->tanggal_masuk_surat,
            'nomor_surat' => $request->nomor_surat,
            'lampiran' => $request->lampiran,
            'perihal' => $request->perihal,
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_surat' => $request->tanggal_surat,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'up_surat' => $request->up_surat,
            'status_surat' => 'pending',
            'update_by' => $user->username,
            'notes' => 'none',
            'lembaga' => $request->lembaga
        ]);
        return response()->json([
            'success' => true,
            //formulir pengajuan pinjaman berhasil dibuat
            'message' => 'the loan application form was successfully created',
        ], 200);
    }

    /**
     * load a surat.
     */
    public function loadSurat(){
        $surat = Surat::orderBy('id', 'ASC')->get();
        $user = User::find(idApi());
        $id_user = $user->id;
        $role = $user->role;

        //check apakah login sebagai user biasa
        //lalu kembalikan / munculkan semua surat berdasarkan yang ia buat
        if($role == 'user'){
            $surat = Surat::where('id_user', $id_user)->get();

        //check apakah login sebagai validator1, validator2
        //lalu kembalikan / munculkan semua surat yang berstatus pending
        } else if($role == 'validator1'){
            $surat = Surat::where('status_surat', 'pending')->get();
        } else if($role == 'validator2'){
            $surat = Surat::where('status_surat', 'validated1')->get();

        } else if($role == 'validator3'){
            $surat = Surat::where('status_surat', 'validated2')
            ->orWhere('update_by', 'validator3')->get();
        //check apakah login sebagai admin
        //lalu kembalikan / munculkan semua surat yang berstatus validated, approved, rejected
        } else if($role == 'admin'){
            $surat = Surat::where('status_surat', 'validated1')
            ->orWhere('status_surat', 'validated2')
            ->orWhere('status_surat', 'validated3')
            ->orWhere('status_surat', 'approved')
            ->orWhere('status_surat', 'rejected')->get();
        }
        return response()->json([
            'success' => true,
            'surats' => $surat,
        ], 200);
    }

    /**
     * update surat
     * @param Request $request
     */
    public function updateSurat(Request $request){
        $surat = Surat::find($request->id);
        $surat->kode_surat = $request->kode_surat;
        $surat->tanggal_masuk_surat = $request->tanggal_masuk_surat;
        $surat->nomor_surat = $request->nomor_surat;
        $surat->lampiran = $request->lampiran;
        $surat->perihal = $request->perihal;
        $surat->nama_kegiatan = $request->nama_kegiatan;
        $surat->tanggal_surat = $request->tanggal_surat;
        $surat->waktu = $request->waktu;
        $surat->tempat = $request->tempat;
        $surat->tanggal_pinjam = $request->tanggal_pinjam;
        $surat->up_surat = $request->up_surat;
        $surat->lembaga = $request->lembaga;
        $surat->save();

        if($surat){
            return response()->json([
                'success' => true,
                'message' => 'success updated !'
            ], 200);
        }
    }

    

    /**
     * delete Surat
     * @param Request request
     */
    public function deleteSurat(Request $request){
        $delete = DB::table('surats')->where('id', $request->id)->delete();
        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'surat successfully deleted.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'failed delete surat'
            ], 400);
        }
    }


    //showing detail surat
    public function showSurat(Request $request){
        $surat = Surat::find($request->id);
        if($surat){
            return response()->json([
                'success' => true,
                'surat' => $surat //json object
            ], 200);
        }
    }

    /**
     * validate surat
     */
    public function validateSurat(Request $request){
        $validator = User::find(idApi());
        $validated = "";
        if($validator->role == 'validator1'){
            $validated = "validated1";
        } else if($validator->role == 'validator2'){
            $validated = "validated2";
        } else if($validator->role == 'validator3'){
            $validated = "validated3";
        }
        $surat = Surat::find($request->id);
        $surat->status_surat = $validated;
        $surat->update_by = $validator->role;
        $surat->validator = $validator->username;
        $surat->notes = $request->notes;
        $surat->save();

        if($surat){
            return response()->json([
                'success' => true,
                'message' => 'validate success.'
            ], 200);
        } else {
            return response([
                'success' => false,
                'message' => 'validate failed.'
            ], 200);
        }
    }

    /**
     * approve surat by admin
     */
    public function approveSurat(Request $request){
        $surat = Surat::find($request->id);
        $surat->status_surat = 'approved';
        $surat->save();

        if($surat){
            return response()->json([
                'success' => true,
                'message' => 'success approved.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'failed to approve'
            ], 200);
        }
    }

    /**
     * reject surat
     */
    public function rejectSurat(Request $request){
        $user = User::find(idApi());
        $surat = Surat::find($request->id);
        $surat->status_surat = 'rejected';
        $surat->update_by = $user->role;
        $surat->notes = $request->notes;
        $surat->save();

        if($surat){
            return response()->json([
                'success' => true,
                'message' => 'success rejected'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'failed rejected'
            ], 200);
        }
    }

    /**
     * upload file pdf 
     */
    public function uploadFile(Request $request){
        $ip = $request->root();
        if($request->file('file')) 
        {
            $file = $request->file('file');
            $filename = time() . '_'. $request->file('file')->getClientOriginalName();
            $filePath = public_path() . '/files/uploads/';
            $file->move($filePath, $filename);
            return response()->json([
                'success' => true,
                'message' => 'file success uploaded',
                'url' => $ip.'/files/uploads/'.$filename
            ], 200);
        }
    }
}
