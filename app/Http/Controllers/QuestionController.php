<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Response;
use App\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function view(Request $request)
    {
        $admin = Auth::user()->admin()->get();
        return view('admin.questions.index')->with('admin', $admin);
    }

    /**
     * return the questions from the database in a paginated structure
     * 
     * @param  integer $page page
     * @return array       questions
     */
    public function index(Request $request, $page) {

        if (!Auth::check()) {
            return Response::json(['error' => ['message' => 'not authorized, not logged in']]);
        } else {
            if (!Auth::user()->isAdmin()) {
                return Response::json(['error' => ['message' => 'not authorized, elevated permissions needed']]);
            }
        }
        
        $recordsPerPage = 10;

        // set the correct page
        $first = ($page - 1) * $recordsPerPage;

        $questionsCount = Question::count();
        $totalPages = ceil( $questionsCount / $recordsPerPage );

        // get the questions for that page
        $questions = Question::orderby('sequence')->skip($first)->take($recordsPerPage)->get();

        // get the number of questions (20 except end of table)
        $count = count($questions);

        // add the number of answers for each question
        for ($i = 0; $i < $count; $i++) {
            $questions[$i]['answersCount'] = $questions[$i]->answersCount();
        }

        $result = array('questions' => $questions, 'pages' => $totalPages);

        // return the result
        return $result;
    }

    public function create(Request $request) {
        $question = $request->all();
        $question['sequence'] = count(Question::all());
        Question::create($question);
    }

    public function edit(Request $request, $id) {
        $question = Question::findOrFail($id);
        $question->question = $request->input('question');
        $question->question_type = $request->input('question_type');
        $question->tip_alters_question = $request->input('tip_alters_question');
        $question->tip = $request->input('tip');

        $question->save();
    }
}
