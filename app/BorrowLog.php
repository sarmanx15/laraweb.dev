<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Book;

class BorrowLog extends Model
{
    //
    protected $fillable=['book_id','user_id','is_returned'];

    public function book(){
    	return $this->belongsTo('App\Book');

    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
}
