<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sold extends Migration{
    public function up(){
        Schema::create('sold', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("stock_id");
            $table->integer("clean");
            $table->string("price_at");
            $table->string("piece");
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('sold');
    }
}
