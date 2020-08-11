<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->unique()->index();
            $table->string('gender');
            $table->string('cover_image_url')->nullable();
            $table->string('cover_image_id')->nullable();
            $table->string('profile_image_url')->nullable();
            $table->string('profile_image_id')->nullable();
            $table->string('current_location')->nullable();
            $table->json('current_work_status')->nullable();
            $table->date('date_of_birth');
            $table->json('phone_number1');
            $table->json('phone_number2')->nullable();
            $table->date('joined_in_year');
            $table->date('left_in_year');
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->date('from_year');
            $table->date('to_year');
            $table->string('company_name')->nullable();
            $table->string('designation')->nullable();
            $table->boolean('is_current')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('qualifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('name')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });


        Schema::create('achievements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('name')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('qualifications');
        Schema::dropIfExists('achievements');
    }
}
