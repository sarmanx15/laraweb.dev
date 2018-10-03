<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Book;

class BorrowLog extends Model
{
    //
    protected $casts = [
    	'is_returned' => 'boolean',
    ];

    public function book(){
    	return $this->belongsTo('App\Book');

    }
    protected $fillable=['book_id','user_id','is_returned'];
    
    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function scopeReturned($query){
    	return $query->where('is_returned', 1);
    }
    public function scopeBorrowed($query){
    	return $query->where('is_returned',0);
    }
}
