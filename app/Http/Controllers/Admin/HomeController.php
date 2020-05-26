<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin;
use App\Http\Controllers\Controller;
use App\Model\Contracts\GenerableInterface;
use App\ModelRepository\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    public $c;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AdminRepository $c)
    {
        $this->c = $c;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }
}
