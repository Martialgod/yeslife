<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('utype', 6);
            $table->string('fname', 250);
            $table->string('lname', 250);
            $table->string('email')->unique();
            $table->timestamp('email_verified')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('activation_token')->nullable();
            $table->timestamps();
            $table->tinyInteger('stat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
