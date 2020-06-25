<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id')->default(1);
            $table->string('title');
            $table->string('slug');
            $table->text('content');
            $table->unsignedBigInteger('comments_count')->default(0);
            $table->string('featured')->default('uploads/posts/default_featured.png');
            $table->dateTime('published_at')->nullable();
            $table->dateTime('featured_at')->nullable();
            $table->softDeletes();
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();
        });
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
