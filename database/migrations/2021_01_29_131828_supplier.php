<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Supplier extends Migration{
    public function up(){
        Schema::create('supplier', function (Blueprint $table) {
            $table->id();
            $table->string("company_name");
            $table->string("email");
            $table->string("address");
            $table->string("phonenumber");
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('supplier');
    }
}
