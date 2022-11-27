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
            $table->id();
            $table->unsignedBigInteger('current_room_id')->nullable();
            $table->string('username', 32)->unique();
            $table->timestamp('username_changed_at')->nullable();
            $table->string('avatar')->default('default/no-avatar.svg');
            $table->string('email', 128)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 128);
            $table->string('steam_usr', 32)->nullable();
            $table->string('xbox_usr', 32)->nullable();
            $table->string('origin_usr', 32)->nullable();
            $table->string('epic_usr', 32)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
