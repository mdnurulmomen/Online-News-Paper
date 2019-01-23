<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('editors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname')->nullable()->default('first');
            $table->string('lastname')->nullable()->default('last');
            $table->string('username')->unique()->default('editor');
            $table->string('password');
            $table->string('email')->unique()->nullable();
<<<<<<< HEAD:core/database/migrations/2018_12_19_073055_create_editors_table.php
            $table->string('category_id');
=======
            $table->string('categories_id');
>>>>>>> f0f8a7997cc10443d00a54414f8a5ee6ed9392eb:core/database/migrations/2018_12_19_073055_create_editors_table.php
            $table->string('profile_pic')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('email_verification')->nullable();
            $table->string('sms_verification')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('editors');
    }
}
