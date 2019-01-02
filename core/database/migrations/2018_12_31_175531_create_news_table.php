<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('category_id');
            $table->string('created_admin_id')->nullable();
            $table->string('created_reporter_id')->nullable();
            $table->string('title');
            $table->string('picpath')->nullable();
            $table->string('description');
            $table->string('status');
            $table->string('updated_admin_id')->nullable();
            $table->string('updated_editor_id')->nullable();
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
