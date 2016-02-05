<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Response;
use DB;
use App\Question;

class QuestionController extends Controller
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
    public function index(Request $request)
    {
        $admin = Auth::user()->admin()->get();
        return view('admin.questions.index')->with('admin', $admin);
    }

    /**
     * return the questions from the database
     * 
     * @return array       questions
     */
    public function all(Request $request) {

        if (!Auth::check()) {
            return Response::json(['error' => ['message' => 'not authorized, not logged in']]);
        } else {
            if (!Auth::user()->isAdmin()) {
                return Response::json(['error' => ['message' => 'not authorized, elevated permissions needed']]);
            }
        }

        $questionsCount = Question::count();

        // get the questions for that page
        $questions = Question::orderby('sequence')->get();

        // add the number of answers for each question
        for ($i = 0; $i < $questionsCount; $i++) {
            $questions[$i]['answersCount'] = $questions[$i]->answersCount();
        }

        $result = array('questions' => $questions, 'questionsCount' => $questionsCount);

        // return the result
        return $result;
    }

    /**
     * switches two questions in the sequence.
     * 
     * @param  integer $seq the higher sequence number
     * @return string      "yay"
     */
    public function changeSequence($seq) {
        $qUp = Question::where('sequence', $seq)->first();
        $qDown = Question::where('sequence', $seq - 1)->first();

        $qUp->sequence = $qUp->sequence -1;
        $qUp->save();

        $qDown->sequence = $qDown->sequence +1;
        $qDown->save();

        return "yay";
    }

    /**
     * gets the create question form view and returns it to the user.
     * 
     * @return view the create form view
     */
    public function create() {
        $admin = Auth::user()->admin()->get();
        return view('admin.questions.create')->with('admin', $admin);
    }

    /**
     * stores a new question in the database.
     * 
     * @param  Request $request the request
     * @return redirect           back to the questions overview
     */
    public function store(Request $request) {
        $question = $request->all();
        if (!array_key_exists('tip_alters_question', $question)) {
            $question['tip_alters_question'] = false;
        }
        $question['sequence'] = count(Question::all()) + 1;
        $question = Question::create($question);

        return redirect("admin/questions/".$question->id);
    }

    /**
     * returns a view with the question data.
     * 
     * @param  Request $request the request
     * @param  int  $id      the id of the question to be returned
     * @return view           the show view
     */
    public function show(Request $request, $id) {
        $question = Question::findOrFail($id);
        $admin = Auth::user()->admin()->get();
        return view('admin.questions.show')->with(array('admin' => $admin, 'question' => $question));
    }

    /**
     * returns a view with a form to edit a question.
     * 
     * @param  Request $request the request
     * @param  int  $id      the question id
     * @return view           the view with the form
     */
    public function edit(Request $request, $id) {
        $question = Question::findOrFail($id);
        $admin = Auth::user()->admin()->get();
        return view('admin.questions.edit')->with(array('admin' => $admin, 'question' => $question));
    }

    /**
     * updates a question from the database.
     * 
     * @param  Request $request the request
     * @param  int  $id      the id of the question to be edited
     * @return redirect           back to the questions overview
     */
    public function update(Request $request, $id) {
        $question = Question::findOrFail($id);
        $question->question = $request->input('question');
        $question->question_type = $request->input('question_type');
        $question->tip_alters_question = null !== $request->input('tip_alters_question') ? true : false;
        $question->tip = $request->input('tip');

        $question->save();

        return redirect("admin/questions");
    }

    /**
     * delete a question from the database.
     * 
     * @param  Request $request the request
     * @param  int  $id      the id of the question
     * @return redirect           back to the questions overview
     */
    public function destroy(Request $request, $id) {
        $question = Question::findOrFail($id);
        $seq = $question->sequence;
        $question->delete();

        $questions = Question::where('sequence', '>', $seq)->get();

        for ($i = 0; $i < count($questions); $i++){
            $questions[$i]->sequence = $questions[$i]->sequence - 1;
            $questions[$i]->save();
        }

        return redirect("admin/questions");
    }
}
