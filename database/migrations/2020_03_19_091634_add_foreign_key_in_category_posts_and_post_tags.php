<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInCategoryPostsAndPostTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::table('category_posts', function (Blueprint $table) {
                $table->unsignedBigInteger('posts_id')->index()->change();
                $table->unsignedBigInteger('category_id')->index()->change();
            });

            Schema::table('post_tags', function (Blueprint $table) {
                $table->unsignedBigInteger('post_id')->index()->change();
                $table->unsignedBigInteger('tag_id')->index()->change();
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
