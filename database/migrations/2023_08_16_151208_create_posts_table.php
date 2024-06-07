<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('category_id')->unsigned()->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('post_image')->nullable();
            $table->text('body');
            $table->timestamps();
        });

       // DB::statement('ALTER TABLE posts ADD FULLTEXT fulltext_index_name (title, body)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
