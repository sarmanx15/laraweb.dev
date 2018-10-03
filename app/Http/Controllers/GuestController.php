<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\DataTables;
use App\Book;
use App\BorrowLog;
use Laratrust\laratrustFacade as Laratrust;


class GuestController extends Controller
{
    //
	public function index(Request $request, Builder $htmlBuilder){
		if($request->ajax()){
			$books = Book::with('author');
			return DataTables::of($books)
			->addColumn('stock', function($book){
			return $book->stock;
			})
			->addColumn('action',function($books){
				if(Laratrust::hasRole('admin')) return '';
				return '<a class="btn btn-xs btn-primary" href="'.route('guest.books.borrow', $books->id).'">Pinjam</a>';
			})->make(true);
		}

		$html = $htmlBuilder
		->addColumn(['data' => 'title', 'name' => 'title' , 'title' => 'Judul'])
		->addColumn(['data' => 'stock', 'name'=>'stock', 'title'=>'Stok', 'orderable'=>false, 'searchable'=>false])
		->addColumn(['data' => 'author.name', 'name' => 'author.name','title'=>'Penulis'])
		->addColumn(['data' => 'action', 'name' => 'action' , 'title' => '', 'orderable' => false, 'searchable' => false]);

		return view('guest.index')->with(compact('html'));
	}

}
