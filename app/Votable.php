<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votable extends Model
{
    protected $primaryKey = 'url';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;
    
    public function voteUp() {
        $this->votes_count++;
        $this->rating++;
        $this->save();
    }
    
    public function voteDown() {
        $this->votes_count++;
        $this->rating--;
        $this->save();
    }
}
