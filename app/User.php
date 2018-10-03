<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Support\Facades\Mail;

use App\Book;
use App\BorrowLog;
use App\Exceptions\BookException;


class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $casts = [
        'is_verified' => 'boolean',
    ];
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function borrow(Book $book){
        // CEK APAKAH MASH ADA STOK BUKU
        if($book->stock < 1){
            throw new BookException("Buku \" $book->title\" sedang tidak tersedia.");
            
        }
        // CEK APAKAH BUKU INI SEDANG DIPINJAM OLEH USER
        if($this->BorrowLogs()->where('book_id', $book->id)->where('is_returned', 0)->count() > 0){
            throw new BookException("Buku \"$book->title\" sedang Anda Pinjam.");
            
        }

        $borrowLog = BorrowLog::create(['user_id'=>$this->id, 'book_id'=>$book->id]);
        return $borrowLog;
    }

    public function borrowLogs(){
        return $this->hasMany('App\BorrowLog');
    }

    // jiks udrt ada token pada field verification_token maka kita pake token itu lagi
    public function generateVerificationToken(){
        $token = $this->verification_token;
        if(!$token){
            $token = str_random(40);
            $this->verification_token = $token;
            $this->save();
        }
        return $token;
    }

    public function sendVerification(){
        $token = $this->generateVerificationToken();
        $user = $this;
        
        Mail::send('auth.emails.verification', compact('user', 'token'), function($m) use($user){
            $m->to($user->email, $user->name)->subject('Verifikasi Akun Larapus.');
        });
    }

    public function verify(){
        $this->is_verified=1;
        $this->verification_token = null;
        $this->save();
    }


}
