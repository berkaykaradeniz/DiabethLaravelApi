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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('Şifre');
            $table->integer('phone_number')->comment('Telefon Numarası')->nullable();;
            $table->date('birth_date')->comment('Doğum Tarihi')->nullable();;
            $table->integer('sexuality')->comment('Cinsiyet 0 Kadın 1 Erkek 2 Belirsiz')->nullable();;
            $table->integer('length')->comment('Boy')->nullable();;
            $table->double('kilo')->comment('Kilo')->nullable();;
            $table->rememberToken();
            $table->timestamps();
        });

        $password = Hash::make('123456789', [
            'memory' => 1024,
            'time' => 2,
            'threads' => 2,
        ]);

        DB::table('users')->insert(
            array(
                'name' => 'admin',
                'surname' => 'admin',
                'password' => bcrypt('Eyhz0zqydgZvDyxFByN0'),
                'email' => 'admin@softverse'
            )
        );
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
};
