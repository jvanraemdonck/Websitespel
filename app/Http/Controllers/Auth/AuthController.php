<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class AuthController extends Controller
{

	/**
	 * the constructor of the Authcontroller class.
	 */
    public function __construct()
    {
    	$this->middleware('auth', ['only' => 'getLogout']);
    	$this->middleware('guest', ['only' => ['getLogin', 'postLogin']]);
    }

    /**
     * Gets called on websitespel/login, returns a view to log in.
     * 
     * @return view the view to log in
     */
    public function getLogin()
    {
    	return view('auth.login');
    }

    /**
     * Login form has been filled out, this function is called.
     * @return redirect
     */
    public function postLogin(Request $request) 
    {
        $this->validate($request, [
            'username' => 'required', 'password' => 'required',
        ]);

    	if ( ! Auth::attempt(['username' => $request->username, 'password' => $request->password], null !== $request->remember) ) {
    		return redirect()->back()->withInput()->withErrors(['message' => 'Aanmelden mislukt...']);
    	}
        else {
            if (Auth::user()->isAdmin()) {
                return redirect('admin');
            } else {
                return redirect('/');
            }
        }
    }

    /**
     * logout view, logs out the currently logged in user.
     * 
     * @return redirect to index
     */
    public function getLogout()
    {
    	Auth::logout();
    	return redirect('login');
    }
}
