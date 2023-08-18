<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Example;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        //examplesテーブルから全てのデータを取得して変数に格納
        // $books = Book::all();
        $book = Book::paginate(10);

        //DBから取得した値をcontrollerからviewに渡す(view/bookのbooks変数に$booksを配列で渡す)
        return view('book.index', ['books' => $book]);
    }

    //routerからurlで飛んできたidをうけとる
    public function detail($id)
    {

        $books = Book::findOrFail($id);

        //DBから取得した値をcontrollerからviewに渡す(view/bookのbooks変数に$booksを配列で渡す)
        return view('book.detail', ['book' => $books]);
    }

}
