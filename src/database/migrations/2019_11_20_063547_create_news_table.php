<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('ncat_id');
            $table->string('image');
            $table->string('heading');
            $table->longText('description');
            $table->dateTime('news_date');
            $table->boolean('is_newsticker')->default(0);
            $table->boolean('is_highlight')->default(0);
            $table->boolean('is_active')->default(1);
            $table->foreign('ncat_id') ->references('id')->on('news_categories') ->onDelete('cascade');
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
        Schema::dropIfExists('news');
    }
}
