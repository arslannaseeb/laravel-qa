<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Auth;

use Illuminate\Http\Request;

class AnswersController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $question->answers()->create(['body'=> $request->body,'user_id' => \Auth::id()]);

        return back();

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);

        return view('answers.edit',compact('question','answer'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);

        $request->validate([
            'body' => 'required',
        ]);

        $answer->update(['body'=>$request->body]);

        return redirect(route('questions.show',$question->slug));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        $this->authorize('delete',$answer);
        $answer->delete();
        
        return back();

    }
}
