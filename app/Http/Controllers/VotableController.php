<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Session;
use App\VotablesFactory;
use App\Votable;
use Illuminate\Http\Request;

class VotableController extends Controller 
{
    public function show(Request $request) 
    {
        $value = $request->session()->pull('successArray', false);
        return view(
            'homepage', 
            [
                'votables' => VotablesFactory::fetch(),
                'successArray' => $value
            ]
        );
    }
    
    public function vote(Request $request) 
    {
        $successArray = [];
        
        if (!empty($request->input('upVoteUrl')) && !empty($request->input('downVoteUrl'))) {
            $upVoteObject= Votable::find($request->input('upVoteUrl'));
            if (!empty($upVoteObject)) {
                $upVoteObject->voteUp();
                $successArray['upVoteObject'] = $upVoteObject;
            }
             
            $successArray['downVoteObjects'] = []; 
            foreach ($request->input('downVoteUrl') as $value) {
                $downVoteObject= Votable::find($value);
                if (!empty($downVoteObject)) {
                    $downVoteObject->voteDown();
                    $successArray['downVoteObjects'][] = $downVoteObject;
                }
            }
            
        }
        
        $request->session()->put('successArray', $successArray);

        return redirect('/');
    }
}