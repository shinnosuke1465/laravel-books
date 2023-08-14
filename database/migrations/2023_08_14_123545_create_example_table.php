<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.テーブルの作成
     */
    public function up(): void
    {
        Schema::create('example', function (Blueprint $table) {
            $table->id();
            $table->timestamps();  //テーブルにデータを入れた際に日付とデータを更新した際に更新日が追加される
        });
    }

    /**
     * Reverse the migrations.テーブルの削除
     */
    public function down(): void
    {
        Schema::dropIfExists('example');
    }
};
