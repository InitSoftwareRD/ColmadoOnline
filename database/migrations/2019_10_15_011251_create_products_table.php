<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',70)->nullable($value = false);
            $table->unsignedBigInteger('category_id');
            $table->mediumText('description');
            $table->mediumText('ingredients');
            $table->float('price',8,2);
            $table->enum('status', ['A', 'I']);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
