<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Progress;
use App\Question;
use App\QuestionTime;
use App\TeamAnswer;
use App\Event;
use App\Team;

class GameController extends Controller
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

    /**
     * The game page itself
     *
     * @return Response
     */
    public function index()
    {
        $team = Auth::user()->team()->first();
        $questionNr = count(Progress::where('team_id', $team->id)->get());

        $question = null;
        $tip = false;
        $times = [];

        if ($questionNr != count(Question::all())) 
        {
            $question = Question::where('sequence', $questionNr+1)->first();
            $result = QuestionTime::where('team_id', $team->id)->where('question_id', $question->id)->get();

            if (count($result) == 0) 
            {
                $questionTime = new QuestionTime();
                $questionTime->team_id = $team->id;
                $questionTime->question_id = $question->id;
                $questionTime->tip = false;
                $questionTime->start_time = \Carbon\Carbon::now()->timestamp;
                $questionTime->save();
                $tip = false;
            } else {
                $tip = $result->first()->tip;
            }
        } else {
            $teams = Team::all();
            $teamsCount = count($teams);

            $question_id = Question::where('sequence', Question::max('sequence'))->first()->id;

            for ($i = 0; $i < $teamsCount; $i++) {
                $qt = QuestionTime::where('team_id', $teams[$i]->id)->where('question_id', $question_id)->first();
                if ($qt == null) continue;
                $end_time = $qt->end_time;
                if ($end_time == null) continue;
                $end_time_string = \Carbon\Carbon::createFromTimestamp($end_time)->toDateTimeString();

                array_push($times, array('name' => $teams[$i]->teamname, 'time' => $end_time_string));
            }

            dd($times);
        }

        return view('game.index')->with(array('question' => $question, 'tip' => $tip, 'end_times' => $times));
    }

    /**
     * Check to see if team's guess was correct
     * @return index page
     */
    public function answer(Request $request) 
    {
        // get team and question
        $team = Auth::user()->team()->first();
        $questionNr = count(Progress::where('team_id', $team->id)->get());
        $question = Question::where('sequence', $questionNr+1)->first();

        // get the answer from the user from the input
        $answer = $request->input('answer');

        // fetch the correct answers from the database
        $rightAnswers = $question->answers()->get();
        $answersCount = count($rightAnswers);

        $correct = false;

        // check if the given answer was correct
        for ($i = 0; $i < $answersCount; $i++) 
        {
            if (strcmp($rightAnswers[$i]->answer, $answer) == 0) {
                $correct = true;
            }
        }

        // create a new record in the team answers table
        TeamAnswer::create(['team_id' => $team->id, 'question_id' =>$question->id,
            'answer' => $answer, 'correct' => $correct]);

        // if the answer was correct, a lot of stuff has to be done here...
        if ($correct) 
        {
            // new record in the progress table
            Progress::create(['team_id' => $team->id, 'question_id' => $question->id]);

            // finish record in the times table
            $qt = QuestionTime::where('question_id', $question->id)
                ->where('team_id', $team->id)->first();
            $qt->end_time = \Carbon\Carbon::now()->timestamp;
            $qt->delta_time = $qt->end_time - $qt->start_time;
            $qt->save();

            Event::create(['type_id' => 1, 'time' => \Carbon\Carbon::now()->timestamp,
                'team_id' => $team->id, 'question_id' => $question->id]);

            $newQuestion = Question::where('sequence', $question->sequence+1)->first();

            if ($newQuestion != null) 
            {
                QuestionTime::create(array('team_id' => $team->id, 'question_id' => $newQuestion->id, 
                    'tip' => false, 'start_time' => \Carbon\Carbon::now()->timestamp));
            }

            return redirect('/');
        } 
        else // if not, it's a little easier...
        {
            return redirect('/')->withErrors(['nope, try again']);
        }
    }

    public function tip() 
    {
        $team = Auth::user()->team()->first();
        $questionNr = count(Progress::where('team_id', $team->id)->get());
        $question = Question::where('sequence', $questionNr+1)->first();

        $qt = QuestionTime::where('question_id', $question->id)
                ->where('team_id', $team->id)->first();
        $qt->tip = true;
        $qt->save();

        return redirect('/');
    }
}
