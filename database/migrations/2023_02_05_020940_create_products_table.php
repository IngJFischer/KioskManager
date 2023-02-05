<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('description', 255)->nullable();
            $table->string('barcode', 15)->nullable();
            $table->unsignedDecimal('listprice', 5, 2);
            $table->tinyInteger('revenue', false, true);
            $table->unsignedDecimal('price', 5, 2);
            $table->foreignId('provider_id')->default(1)->constrained()->onDelete('cascade');
            $table->enum('unit_sale', ['yes', 'no']);
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
        Schema::dropIfExists('products');
    }
};