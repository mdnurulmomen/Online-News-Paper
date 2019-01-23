<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable()->default('name');
            $table->string('color')->nullable()->default('color');
            $table->string('header_categories')->nullable()->default('[]');
            $table->string('headlines')->nullable()->default('[]');
            $table->string('sub_headlines')->nullable()->default('[]');
            $table->string('index_categories')->nullable()->default('[]');
            $table->string('footer_categories')->nullable()->default('[]');
            $table->string('footer')->nullable()->default('footer');
            $table->string('logo')->nullable()->default('logo');
            $table->string('default_icon')->nullable()->default('defaulticon');
            $table->string('ad_image_ids')->nullable();
            $table->string('news_verification')->default(1);
            $table->string('user_registration')->default(1);
            $table->string('email_verification')->nullable()->default(0);
            $table->string('sms_verification')->nullable()->default(0);
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
        Schema::dropIfExists('settings');
    }
}
