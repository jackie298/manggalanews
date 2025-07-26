<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Drop foreign key dulu
            $table->dropForeign(['category_id']);

            // Baru drop kolom
            $table->dropColumn('category_id');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();

            // Restore foreign key kalau dibutuhkan
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
};
