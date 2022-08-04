<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Models\Berkas;
use Illuminate\Support\Facades\Auth;

class DashboardController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {


        return view('admin.dashboard');
    }
}
