<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Team;
use App\User;

use Auth;

class TeamController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $admin = Auth::user()->admin()->get();
        return view('admin.teams.index')->with('admin', $admin);
    }

    /**
     * return the questions from the database
     * 
     * @return array       questions
     */
    public function all()
    {
        if (!Auth::check()) {
            return Response::json(['error' => ['message' => 'not authorized, not logged in']]);
        } else {
            if (!Auth::user()->isAdmin()) {
                return Response::json(['error' => ['message' => 'not authorized, elevated permissions needed']]);
            }
        }

        $teamsCount = Team::count();

        // get the questions for that page
        $teams = Team::all();

        for ($i = 0; $i < count($teams); $i++) {
            $teams[$i]['username'] = User::findOrFail($teams[$i]->user_id)->username;
        }

        $result = array('teams' => $teams, 'teamsCount' => $teamsCount);

        // return the result
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $admin = Auth::user()->admin()->get();
        return view('admin.teams.create')->with('admin', $admin);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $password = $this->createPassword();

        $user = new User;
        $user->username = $request->input('username');
        $user->password = \Hash::make($password);
        $user->admin= false;
        $user->save();
        $uId = $user->id;

        $team = new Team;
        $team->teamname = $request->input('teamname');
        $team->avatar = $request->input('avatar');
        $team->color = $request->input('color');
        $team->extra_tip = 0;
        $team->actives = 0;
        $team->user_id = $uId;
        $team->save();

        return redirect("admin/teams/".$team->id)->with('password', $password);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $team = Team::findOrFail($id);
        $admin = Auth::user()->admin()->get();
        $username = User::findOrFail($team->user_id)->username;
        return view('admin.teams.show')->with(array('admin' => $admin, 'team' => $team, 'username' => $username));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $team = Team::findOrFail($id);
        $admin = Auth::user()->admin()->get();
        $username = User::findOrFail($team->user_id)->username;
        return view('admin.teams.edit')->with(array('admin' => $admin, 'team' => $team, 'username' => $username));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $team->teamname = $request->input('teamname');
        $team->avatar = $request->input('avatar');
        $team->color = $request->input('color');

        $team->save();

        $user = User::findOrFail($team->user_id);
        $user->username = $request->input('username');
        $user->save();

        return redirect('admin/teams');
    }

    /**
     * Remove the specified resource()
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return redirect('admin/teams');
    }

    public function resetPassword($id) 
    {
        $team = Team::findOrFail($id);
        $user = User::findOrFail($team->user_id);

        $password = $this->createPassword();

        $user->password = \Hash::make($password);
        $user->save();

        return redirect('admin/teams/'.$id)->with('password', $password);
    }

    public function resetPasswords($length = 12)
    {
        $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['Team Naam', 'Gebruikersnaam', 'Paswoord']);

        $teams = Team::all();
        $nrOfTeams = count($teams);

        for ($i = 0; $i < $nrOfTeams; $i++) {
            $user = User::findOrFail($teams[$i]->user_id);

            $password = $this->createPassword();

            $user->password = \Hash::make($password);
            $user->save();

            $csv->insertOne([$teams[$i]->teamname, $user->username, $password]);
        }

        $csv->output('hhd_passwords.csv');
    }

    private function createPassword($length = 12) 
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
        $password = "";

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $password .= mb_substr($chars, $index, 1);
        }

        return $password;
    }
}
