<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Instansi;
use App\Models\TransaksiUpload;
use App\Http\Requests\StoreTransaksiUploadRequest;
use App\Http\Requests\UpdateTransaksiUploadRequest;
use Illuminate\Http\Request;
use ZipArchive;

class TransaksiUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = array();
        $instansis = Instansi::all();
        foreach ($instansis as $instansi) 
        {
            $kategories = Server::where('instansi_id', '=', $instansi->id)->get();
            array_push($list, $kategories);
        }
        // dd($list[0]);
        $opds = $list[1];
        $kecs = $list[0];
        $kels = $list[2];
        $pkms = $list[3];
        $bags = $list[4];
        return view('pages.upload', compact('opds','kecs','kels','pkms','bags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransaksiUploadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaksiUploadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransaksiUpload  $transaksiUpload
     * @return \Illuminate\Http\Response
     */
    public function show(TransaksiUpload $transaksiUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransaksiUpload  $transaksiUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(TransaksiUpload $transaksiUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransaksiUploadRequest  $request
     * @param  \App\Models\TransaksiUpload  $transaksiUpload
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaksiUploadRequest $request, TransaksiUpload $transaksiUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransaksiUpload  $transaksiUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransaksiUpload $transaksiUpload)
    {
        //
    }

    public function files()
    {
        return view('pages.uploadfile');
    }

    public function proses_upload(Request $request)
    {
		$this->validate($request, [
			'file' => 'required|file|mimes:png'
		]);
 
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
		$tujuan_upload = 'data_file';
 
        // upload file
		$file->move($tujuan_upload, $file->getClientOriginalName());
        $paths = public_path().'/'.$tujuan_upload.'/'.$file->getClientOriginalName();
        
        $ctrlc = copy($paths, public_path().'/file-login/bup.png');
        if ($ctrlc > 0)
        {
            return redirect()->route('files')->with('success','Berhasil Upload File Ke Sistem!');
        }
        else
        {
            return redirect()->route('files')->with('gagal','Gagal Upload File Ke Sistem!');
        }
	}
}
