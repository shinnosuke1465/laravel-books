<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
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
}
