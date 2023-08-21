<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
// use Validator;

class BookController extends Controller
{

    public function index(Request $request)
    {
        // //booksテーブルから全てのデータを取得して変数に格納
        // // $books = Book::all();
        // $book = Book::paginate(10);

        // //DBから取得した値をcontrollerからviewに渡す(view/bookのbooks変数に$booksを配列で渡す)
        // return view('book.index', ['books' => $book]);

        // $requestは検索した値が渡ってくる
        //only...()の中で指定した値以外入ってこない
        $input = $request->only('name', 'status', 'author', 'publication', 'note');
        $books = Book::search($input)->orderBy('id', 'desc')->paginate(10);
        //        $books = Book::paginate(10);

        //booksテーブルから全てのpublication(出版)をグループ化して配列に詰め替える
        //$publications=[出版名の配列]
        $publications = Book::select('publication')->groupBy('publication')->pluck('publication');
        $authors = Book::select('author')->groupBy('author')->pluck('author');
        //        $statuses = Book::select('status')->groupBy('status')->pluck('status');

        return view(
            'book.index',
            [
                'books' => $books,
                // selectboxの値
                'publications' => $publications,
                'authors' => $authors,
                //'statuses' => $statuses,

                // 検索する値
                'name' => $input['name'] ?? '',
                'publication' => $input['publication'] ?? '',
                'author' => $input['author'] ?? '',
                'status' => $input['status'] ?? '',
                'note' => $input['note'] ?? '',
            ]
        );
    }

    //routerからurlで飛んできたidをうけとる
    public function detail($id)
    {

        $book = Book::findOrFail($id);

        //DBから取得した値をcontrollerからviewに渡す(view/bookのbooks変数に$booksを配列で渡す)
        return view('book.detail', ['book' => $book]);
    }

    public function edit($id)
    {

        $book = Book::find($id);

        //DBから取得した値をcontrollerからviewに渡す(view/bookのbooks変数に$booksを配列で渡す)
        return view('book.edit', ['book' => $book]);
    }

    public function update(BookRequest $request)
    {
        try {

            //以下のDBのupdateの文でどっかでエラーが発生したらcatchに飛ぶ処理
            DB::beginTransaction();

            $book = Book::find($request->input('id'));
            $book->name = $request->input('name');
            $book->status = $request->input('status');
            $book->author = $request->input('author');
            $book->publication = $request->input('publication');
            $book->read_at = $request->input('read_at');
            $book->note = $request->input('note');
            $book->save();
            DB::commit();

            //変更が完了したらbook.indexにリダイレクトしてメッセージ表示
            return redirect('book')->with('status', '本を更新しました。');
        } catch (\Exception $ex) {
            //値の変更の取り消し
            DB::rollback();
            logger($ex->getMessage());
            return redirect('book')->withErrors($ex->getMessage());
        }
    }

    public function new()
    {
        return view('book.new');
    }

    public function create(Request $request)
    {
        try {
            Book::create($request->all());
            return redirect('book')->with('status', '本を作成しました。');
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect('book')->withErrors($ex->getMessage());
        }
    }

    public function remove($id)
    {
        try {
            Book::find($id)->delete();
            return redirect('book')->with('status', '本を削除しました。');
        } catch (\Exception $ex) {
            logger($ex->getMessage());
            return redirect('book')->withErrors($ex->getMessage());
        }
    }
}
