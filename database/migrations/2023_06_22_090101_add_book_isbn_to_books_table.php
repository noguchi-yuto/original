<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('book_isbn')->nullable();
            $table->string('book_author')->nullable();
            $table->string('book_coverURL')->nullable();
            $table->string('book_publisher')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('book_isbn');
            $table->dropColumn('book_author');
            $table->dropColumn('book_coverURL');
            $table->dropColumn('books_publisher');
        });
    }
};
