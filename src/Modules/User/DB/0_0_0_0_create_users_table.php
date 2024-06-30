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
            $table->string('name')->nullable();
            $table->string('mobile')->unique()->nullable();
            $table->string('new_mobile')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->decimal('wallet',20,2)->default(0);
            $table->string('lang', 2)->default('ar');
            $table->string('type', 20)->default(\App\Enum\UserType::CLIENT);
            $table->boolean('status')->default(false)->comment('for mobile activate');
            $table->boolean('notify')->default(true)->comment('for notification');
            $table->boolean('banned')->default(false)->comment('for block and unblock');
            $table->string('lang' , 10)->default('ar');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
