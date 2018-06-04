<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Session;
use App\VotablesFactory;
use App\Votable;
use Illuminate\Http\Request;

class HighscoreController extends Controller 
{
    public function show(Request $request) 
    {
        return view(
            'highscore', 
            [
                'highscoreArray' => Votable::where('votes_count', '>', 0)
                   ->orderBy('rating', 'desc')
                   ->take(10)
                   ->get()
            ]
        );
    }
}