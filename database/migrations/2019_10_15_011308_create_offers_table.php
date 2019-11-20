<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('begin_at')->nullable($value=true);
            $table->timestamp('end_at')->nullable($value=true);
            $table->unsignedBigInteger('product_id');
            $table->enum('status', ['A', 'I']);
            $table->integer('porciento')->nullable(false);
            $table->mediumText('promotion_text');
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
