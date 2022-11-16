<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();
            $table->string('avatar')->default('avatars/default/no-avatar.svg');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('steam_link')->nullable();
            $table->string('xbox_link')->nullable();
            $table->string('origin_link')->nullable();
            $table->string('epic_link')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedBigInteger('current_room_id')->default(0);

//            $table->foreign('current_room_id')->references('id')->on('rooms')->cascadeOnDelete();

        });
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
