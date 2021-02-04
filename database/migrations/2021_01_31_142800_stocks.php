<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Stocks extends Migration
{
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignId("supplier_id");
            $table->integer("count");
            $table->integer("price");
            $table->date("expire_date");
            $table->integer("is_debt");
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
