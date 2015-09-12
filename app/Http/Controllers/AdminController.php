<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
	}

    public function index()
    {
    	return "admin index";
    }
}
