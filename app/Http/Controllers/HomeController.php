<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $location = public_path().'/data_file';

        $fi = glob($location.'/*.*');
        $files = count($fi);

        $ffs = scandir($location);
        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);

        $servers = count(Server::all());
        $opds = count(Server::where('instansi_id','=',2)->get());
        $kels = count(Server::where('instansi_id','=',3)->get());
        $kecs = count(Server::where('instansi_id','=',1)->get());
        $pkms = count(Server::where('instansi_id','=',4)->get());
        $bags = count(Server::where('instansi_id','=',6)->get());
        return view('pages.dashboard', compact('servers','files','opds','kels','kecs','pkms','bags','fi','ffs'));
    }
}
