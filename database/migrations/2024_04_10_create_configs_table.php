<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('username')->default(config('app.register.UnameMarkazi'));
            $table->string('password')->default(config('app.register.password'));
            $table->string('seat_one')->default(config('app.btn.first'));
            $table->string('seat_two')->default(config('app.btn.second'));
            $table->string('seat_three')->default(config('app.btn.third'));
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('configs');
    }
}; 