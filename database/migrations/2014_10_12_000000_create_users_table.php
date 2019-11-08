<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('last_name',50);
            $table->enum('sex', ['M', 'F','O']);
            $table->string('email',50)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('identity',20)->nullable();
            $table->string('phone',20);
            $table->enum('status', ['A', 'I']);
            $table->unsignedBigInteger('rol_id');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('rol_id')->references('id')->on('rol');
            
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
