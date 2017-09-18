<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagblogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagblogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('blog_tagblog', function (Blueprint $table) {
            
            $table->integer('blog_id')->unsigned()->index();
            $table->foreign('blog_id')->references('id')->on('blogs')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->integer('tagblog_id')->unsigned()->index();
            $table->foreign('tagblog_id')->references('id')->on('tagblogs')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('blog_tagblog');
        Schema::dropIfExists('tagblogs');
    }
}
