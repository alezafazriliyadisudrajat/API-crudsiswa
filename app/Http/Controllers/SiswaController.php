<?php

namespace App\Http\Controllers;

use App\Helpers\formatAPI;
use App\Models\Siswa;
use Exception;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data = Siswa::all();

        if($data){
            return formatAPI::createAPI(200, 'berhasil', $data);
         }else{
            return formatAPI::createAPI(400, 'Failed');
        }
    }

    public function store(Request $request)
    {
        try{
            //untuk create ke database
           $siswa = Siswa::create($request->all());

           //untuk data siswa where id_siswa = id_siswa

           //check data is valid return data : failed
           $data = Siswa::where('id_siswa', '=', $siswa->id_siswa)->get();

           if($data){
            return formatAPI::createAPI(200, 'berhasil', $data);
         }else{
            return formatAPI::createAPI(400, 'Failed');
        }
        }catch(Exception $error){
            return formatAPI::createAPI(400, 'gagal',$error);
        }
    }

    public function show($id_siswa)
    {
        try{
            $data = Siswa::where('id_siswa', '=',$id_siswa)->first();
            if($data){
                return formatAPI::createAPI(200, 'berhasil', $data);
             }else{
                return formatAPI::createAPI(400, 'Failed');
            }
        }catch(Exception $error){
            return formatAPI::createAPI(400, 'Failed',$error);
        }
    }

    public function update (Request $request, $id_siswa)
    {
        try{
            $siswa = Siswa::findorfail($id_siswa);
            $siswa->update($request->all());

            $data = Siswa::where('id','=',$siswa->id)->get();
            if($data){
                return formatAPI::createAPI(200, 'berhasil', $data);
             }else{
                return formatAPI::createAPI(400, 'Failed');
            }

        }catch(Exception $error){
            return formatAPI::createAPI(400, 'Gagal',$error);
        }
    }

    public function destroy($id){
        try{
            $siswa = Siswa::findOrFail($id);
            $data = $siswa->delete();
            if($data){
                return formatAPI::createAPI(200, 'berhasil');
            }else{
                return formatAPI::createAPI(400, 'gagal');
            }
        }catch(Exception $error){
            return formatAPI::createAPI(400, 'gagal', $error);
        }
    }
}
