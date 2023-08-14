<?php

namespace Database\Seeders;

use App\Models\Example;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('examples')->insert([
        //     'id' => 10,
        // ]);
        
        //ExampleFactory.phpを呼び出してnameとaddressカラムのデータを3つ作ってデータを挿入する
        Example::factory()->count(3)->create();
    }
}
