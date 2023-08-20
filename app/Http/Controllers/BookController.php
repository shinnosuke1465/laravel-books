<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Validator;

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

    public function update(Request $request)
    {
        try {

            // NOTE: コントローラーに対してバリデーションを当てる方法
//            $validated = Validator::make($request->all(), [
//                'name' => 'required|max:255',
//                'status' => ['required', Rule::in(BOOK::BOOK_STATUS_ARRAY)],
//            ]);
//
//            if($validated->fails()) {
//                return redirect()->route('book.edit', ['id' => $request->input('id')])->withErrors($validated)->withInput();
//            }

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

    public function new(){
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
