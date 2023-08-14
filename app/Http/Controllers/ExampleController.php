<?php

namespace App\Http\Controllers;

use App\Models\Example;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index() {
        return view('welcome');
    }
    public function example() {
        //examplesテーブルから全てのデータを取得して変数に格納
        $examples = Example::all();
        // //idが1のものだけ絞り込んで取得
        // $examples = Example::find(1);
        // //条件を指定。where文はgetが必要
        // $examples = Example::where('id', 1)->get();
        // //複数条件指定
        // $examples = Example::whereIn('id', [1,2])->get();

        //DBから取得した値をcontrollerからviewに渡す(view/exampleのexamples変数に$examplesを配列で渡す)
        return view('example',['examples' => $examples]);
    }
}
