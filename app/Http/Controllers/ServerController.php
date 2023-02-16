<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Instansi;
use App\Http\Requests\StoreServerRequest;
use App\Http\Requests\UpdateServerRequest;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servers = Server::paginate(20);
        return view('pages.server', compact('servers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $instansis = Instansi::all();
        return view('pages.servercreate', compact('instansis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreServerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServerRequest $request)
    {
        Server::create($request->all());
        return redirect()->route('server.index')->with('success','Berhasil Ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function show(Server $server)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function edit(Server $server)
    {
        $instansis = Instansi::all();
        return view('pages.serverupdate', compact('server','instansis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateServerRequest  $request
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServerRequest $request, Server $server)
    {
        $server->update($request->all());
        return redirect()->route('server.index')->with('success','Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Server  $server
     * @return \Illuminate\Http\Response
     */
    public function destroy(Server $server)
    {
        Server::destroy($server->id);
    }

    public function exec(Request $request)
    {
        $this->validate($request, [
			'list' => 'required'
		]);

        $ids = $request->input('list');
        
            // $servers = Server::all();
        
        
        // $servers = array("172.11.11.10");
        $username = "alx";
        $password = "netw0rk)OKM(IJN";

        $dir = public_path().'\file-login';
        $remote_dir = '/flash/file-login';
        $messages = array();

        // foreach ($servers as $server)
        // {
        foreach ($ids as $id)
        {
            $server = Server::find($id);
            $server_address = $server->ip_address;

            // try to connect
            // $ftp_conn = ServerController::connect($server_address, $username, $password);
            $ftp_conn = ftp_connect($server_address);

            if(! $ftp_conn)
            {
                $error_msg = 'Tidak bisa terhubung ke '.$server->nama;
                array_push($messages, $error_msg);
            }
            else
            {
                ftp_login($ftp_conn, $username, $password);
                ftp_pasv($ftp_conn, true);
                
                ServerController::deleteDirFile($ftp_conn, $remote_dir);
                ServerController::listFolder($dir, $remote_dir, $ftp_conn);
                ServerController::listFiles($dir, $remote_dir, $ftp_conn);

                $success_msg = 'Upload berhasil pada '.$server->nama;
                array_push($messages, $success_msg);
                ftp_close($ftp_conn);
            }
        // }
        }
        $total = count($messages);
        return view('pages.uploadreport', compact('messages','total'));
    }

    private static function deleteDirFile($ftp_conn, $remote_dir)
    {
        $ffs = ftp_nlist($ftp_conn, $remote_dir);
        $files = array();
        if ($ffs!=false)
        {
            unset($ffs[array_search('.', $ffs, true)]);
            unset($ffs[array_search('..', $ffs, true)]);
            // prevent empty ordered elements
            if (count($ffs) >= 1)
            {
                foreach($ffs as $ff)
                {
                    if ( @ftp_chdir( $ftp_conn, $remote_dir.'/'.$ff ) ) {
                        ServerController::deleteDirFile($ftp_conn, $remote_dir.'/'.$ff);
                        ftp_rmdir($ftp_conn, $remote_dir.'/'.$ff);
                    } else {
                        error_reporting(0);
                        ftp_delete($ftp_conn, $remote_dir.'/'.$ff);
                    }
                }
            }
            ftp_rmdir($ftp_conn, $remote_dir);
        }
        
    }

    private static function listFolder($dir, $remote_dir, $ftp_conn)
    {
        $ffs = scandir($dir);
        $folders = array();
        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);
        // prevent empty ordered elements
        if (count($ffs) >= 1)
        {
            foreach($ffs as $ff)
            {
                if (is_dir($dir.'\\'.$ff))
                {
                    ServerController::listFolder($dir.'\\'.$ff, $remote_dir.'/'.$ff, $ftp_conn);
                    array_push($folders, $remote_dir.'/'.$ff);
                }
            }
        }
        ServerController::createDir($folders, $ftp_conn);
    }

    private static function listFiles($dir, $remote_dir, $ftp_conn)
    {
        $ffs = scandir($dir);
        $files = array();
        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);
        // prevent empty ordered elements
        if (count($ffs) >= 1)
        {
            foreach($ffs as $ff)
            {
                if (is_dir($dir.'\\'.$ff))
                {
                    ServerController::listFiles($dir.'\\'.$ff, $remote_dir.'/'.$ff, $ftp_conn);
                }
                else
                {
                    array_push($files, array($remote_dir.'/'.$ff, $dir.'\\'.$ff));
                }
            }
        }
        ServerController::uploadFile($files, $ftp_conn);
    }

    private static function createDir($folders, $ftp_conn)
    {
        foreach($folders as $folder)
        {
            $mkdir = ServerController::makeDirectory($ftp_conn, $folder);
            if (! $mkdir)
            {
                $error_msg = 'Tidak bisa membuat folder';
            }
        }
    }

    private static function uploadFile($files, $ftp_conn)
    {
        foreach($files as $file)
        {
            $chk_uploaded = ftp_put($ftp_conn, $file[0], $file[1]);

            // $chk_uploaded = ftp_put($ftp_conn, $file[0], $file[1], FTP_BINARY);

            // $chk_uploaded = ftp_put($ftp_conn, $file[0], $file[1], FTP_ASCII);
            if (! $chk_uploaded)
            {
                $error_msg = 'Tidak bisa upload file';
            }   
        }
    }

    private static function connect($server_address, $username, $password)
	{
		try {
			$ftp_conn = ftp_connect($server_address) or die ("Could not connect to $server_address");
			ftp_login($ftp_conn, $username, $password);
		} catch (Exception $e) {
			return FALSE;
		}
		return $ftp_conn;
	}

    private static function makeDirectory($ftp_stream, $dir)
	{
		// if directory already exists or can be immediately created return true
		if (ServerController::ftpIsDir($ftp_stream, $dir) || @ftp_mkdir($ftp_stream, $dir)) return true;
		// otherwise recursively try to make the directory
		if (!ServerController::makeDirectory($ftp_stream, dirname($dir))) return false;
		// final step to create the directory
		return ftp_mkdir($ftp_stream, $dir);
	}	

	private static function ftpIsDir($ftp_stream, $dir)
	{
	   // get current directory
	   $original_directory = ftp_pwd($ftp_stream);
	   // test if you can change directory to $dir
	   // suppress errors in case $dir is not a file or not a directory
	   if ( @ftp_chdir( $ftp_stream, $dir ) ) {
		   // If it is a directory, then change the directory back to the original directory
		   ftp_chdir( $ftp_stream, $original_directory );
		   return true;
	   } else {
		   return false;
	   }
	}

    function cidr()
    {
        var_dump(ServerController::cidrToRange("73.35.143.0/24"));
    }

    function cidrToRange($cidr) {
        $range = array();
        $cidr = explode('/', $cidr);
        $range[0] = long2ip((ip2long($cidr[0])) & ((-1 << (32 - (int)$cidr[1]))));
        $range[1] = long2ip((ip2long($range[0])) + pow(2, (32 - (int)$cidr[1])) - 1);
        return $range;
      }
}