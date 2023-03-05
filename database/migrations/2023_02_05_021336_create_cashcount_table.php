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
        Schema::create('cashcount', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operation_id')->constrained()->onDelete('cascade');
            $table->unsignedDecimal('total', 10, 2);
            $table->unsignedDecimal('costs', 10, 2);
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
        Schema::dropIfExists('cashcount');
    }
};
