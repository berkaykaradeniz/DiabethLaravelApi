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
        Schema::create('values', function (Blueprint $table) {
            $table->id();
            $table->timestamp('value_date')->comment('Kayıt Tarihi'); //Kayıt Tarihi     
            $table->string('deviation')->comment('Sapma Değeri'); //Sapma Değeri
            $table->integer('average')->comment('Ortalama Değer'); //Ortalama Değer       
            $table->integer('hiper')->comment('Hiper Değeri'); //Hiper       
            $table->integer('hipo')->comment('Hipo Değeri'); //Hipo     
            $table->timestamps();
        });

        Schema::table('values', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('dusers'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('values');
    }
};
