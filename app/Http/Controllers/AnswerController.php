<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Question;
use App\Answer;
use Auth;

class AnswerController extends Controller
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
    public function index($qId)
    {
        $admin = Auth::user()->admin()->get();
        return view('admin.answers.index')->with('qId', $qId)->with('admin', $admin);
    }

    /**
     * api function get answers for a questions
     * 
     * @param  $request the request
     * @param  int $qid     the question for which to fetch answers
     * @return json          the answers json object
     */
    public function all(Request $request, $qId) 
    {
        if (!Auth::check()) {
            return Response::json(['error' => ['message' => 'not authorized, not logged in']]);
        } else {
            if (!Auth::user()->isAdmin()) {
                return Response::json(['error' => ['message' => 'not authorized, elevated permissions needed']]);
            }
        }

        $answerCount = Answer::count();

        // get the questions for that page
        $answers = Answer::where('question_id', $qId)->get();

        $result = array('answers' => $answers, 'answerCount' => $answerCount, 'qId' => $qId);

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($qId)
    {
        $admin = Auth::user()->admin()->get();
        return view('admin.answers.create')->with(array('admin' => $admin, 'qId' => $qId));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $qId)
    {
        $answer = $request->all();
        $answer['question_id'] = $qId;
        $answer = Answer::create($answer);

        return redirect('admin/questions/'.$qId.'/answers/'.$answer->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($qId, $id)
    {
        $answer = Answer::findOrFail($id);
        $admin = Auth::user()->admin()->get();
        return view('admin.answers.show')->with(array('admin' => $admin, 'answer' => $answer, 'qId' =>$qId));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($qId, $id)
    {
        $answer = Answer::findOrFail($id);
        $admin = Auth::user()->admin()->get();
        return view('admin.answers.edit')->with(array('admin' => $admin, 'answer' => $answer, 'qId' => $qId));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $qId, $id)
    {
        $answer = Answer::findOrFail($id);
        $answer->answer = $request->input('answer');
        $answer->save();

        return redirect('admin/questions/'.$qId.'/answers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($qId, $id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();

        return redirect('admin/questions/'.$qId.'/answers');
    }
}
