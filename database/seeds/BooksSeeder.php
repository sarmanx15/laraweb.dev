<?php

use Illuminate\Database\Seeder;
use App\Author;
use App\Book;
use App\User;
use App\BorrowLog;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Penulis
        $author1 = Author::create(['name'=>'Muhammad Mail Adam']);
        $author2 = Author::create(['name'=>'Eka Paramita']);
        $author3 = Author::create(['name'=>'Tini Yunita']);

        $book1 = Book::create(['title'=>'Kupinang Engkau dengan Hamdalah','amount'=>3,'author_id'=>$author1->id]);
        $book2 = Book::create(['title'=>'Juragan Keong Racun','amount'=>5,'author_id'=>$author2->id]);
        $book3 = Book::create(['title'=>'Mencari Jati Diri Orang Lain','amount'=>4,'author_id'=>$author3->id]);
        $book3 = Book::create(['title'=>'Ada Apa dengan Julak','amount'=>4,'author_id'=>$author3->id]);

        //  SAMPLE PEMINJAMAN BUKU
        $member = User::where('email','rizkymember@gmail.com')->first();
        BorrowLog::create(['user_id' => $member->id, 'book_id' => $book1->id, 'is_returned'=> 0]);
        BorrowLog::create(['user_id' => $member->id, 'book_id' => $book2->id, 'is_returned'=> 0]);
        BorrowLog::create(['user_id' => $member->id, 'book_id' => $book3->id, 'is_returned'=> 1]);

    }
}
