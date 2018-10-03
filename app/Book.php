<?php

namespace App;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = ['title','author_id','amount'];

    public function author(){
    	return $this->belongsTo('App\Author');
    }
    public function borrowLogs(){
    	return $this->hasMany('App\BorrowLog');
    }

    public function getStockAttribute(){
    	$borrowed = $this->borrowLogs()->borrowed()->count();
    	$stock = $this->amount - $borrowed;
    	return $stock;
    }

    public static function boot(){
    	parent::boot();
    	self::updating(function($book){
    		if($book->amount < $book->borrowed){
    			Session::flash("flash_notification",[
    				"level"		=> "danger",
    				"message"	=> "Jumlah buku \"$book->title \" harus >= ".$book->borrowed
    			]);
    			return false;
    		}
    	});

    	self::deleting(function($book){
    		if($book->borrowLogs()->count() > 0){
    			Session::flash("flash_notification", [
    				"level"		=> "danger",
    				"message"	=> "Buku \" $book->title \"sudah dipinjam"]);
    			return false;
    		}
    	});
    }
    	public function getBorrowedAttribute(){
    		return $this->borrowLogs()->borrowed()->count();
    	}
    
}
