<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['name', 'status', 'author', 'publication', 'read_at', 'note'];

    use HasFactory;

    /*
    * id: 一意(autoincrement), null×, 同じ値×
    * name: length 255, not null(必ず値を入れる)
    * status: tinyInteger(=小さい値を入れる)(1~255), not null, *         1:読書中,2:未読,3:読破,4:読みたい
    * author:著者 length 255, not null許可
    * publication: 出版, length 255, not null許可
    * read_at: 読み終わった日、date(日付 yyyy-mm-dd), null許可
    * note: メモ(備考) text, null許可
    * timestamps (updated_at, created_at)
    */

    public const BOOK_STATUS_READING = 1;
    public const BOOK_STATUS_UNREAD = 2;
    public const BOOK_STATUS_DONE = 3;
    public const BOOK_STATUS_WANT_READ = 4;

    public const BOOK_STATUS_NAME_READING = '読書中';
    public const BOOK_STATUS_NAME_UNREAD = '未読';
    public const BOOK_STATUS_NAME_DONE = '読破';
    public const BOOK_STATUS_NAME_WANT_READ = '読みたい';

    public const BOOK_STATUS_OBJECT = [
        self::BOOK_STATUS_READING => self::BOOK_STATUS_NAME_READING,
        self::BOOK_STATUS_UNREAD => self::BOOK_STATUS_NAME_UNREAD,
        self::BOOK_STATUS_DONE => self::BOOK_STATUS_NAME_DONE,
        self::BOOK_STATUS_WANT_READ => self::BOOK_STATUS_NAME_WANT_READ,
    ];

    public const BOOK_STATUS_ARRAY = [
        self::BOOK_STATUS_READING,
        self::BOOK_STATUS_UNREAD,
        self::BOOK_STATUS_DONE,
        self::BOOK_STATUS_WANT_READ,
    ];

    // scope
    // グローバルスコープ：モデルを利用する際に、毎回呼び出されるスコープ（where文とかのquery関数）
    // ローカルスコープ：スコープを利用したい場合に、自身で都度呼び出すスコープ
    // scopeは利用する際に含まない。大文字小文字もどちらでもOK。 Book::search();
    // 第一引数は必ず$queryになる。
    public function scopeSearch($query, $search)
    {
        //$searchは検索バーで検索された値。
        //なければ''(空文字)を格納
        $name = $search['name'] ?? '';
        $status = $search['status'] ?? '';
        $author = $search['author'] ?? '';
        $publication = $search['publication'] ?? '';
        $note = $search['note'] ?? '';

        //when....$nameに値がセットされていた時以下の関数を実行する
        //$対象の変数->where('対象のカラム名', 'like', "%{$キーワードを代入した変数}%")->get();

        $query->when($name, function ($query, $name) {
            $query->where('name', 'like', "%$name%");
        });

        $query->when($status, function ($query, $status) {
            $query->where('status', $status);
        });

        $query->when($author, function ($query, $author) {
            $query->where('author', $author);
        });

        $query->when($publication, function ($query, $publication) {
            $query->where('publication', $publication);
        });

        $query->when($note, function ($query, $note) {
            $query->where('note', 'like', "%$note%");
        });

        return $query;
    }



}
