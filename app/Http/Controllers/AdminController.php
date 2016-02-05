<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class AdminController extends Controller
{

	/**
	 * Contructor for this controller.
	 * 
	 * @return nothing
	 */
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('admin');
	}

    public function index()
    {
    	$admin = Auth::user()->admin()->get();
    	return view('admin.index')->with('admin', $admin);
    }
}
