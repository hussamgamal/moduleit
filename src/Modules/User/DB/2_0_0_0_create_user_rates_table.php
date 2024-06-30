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
        Schema::create('user_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Modules\User\Models\User::class)->index()->nullable()->constrained();
            $table->foreignIdFor(\Modules\Orders\Models\Order::class)->index()->nullable()->constrained();
            $table->float('rate');
            $table->string('text')->nullable();
            $table->morphs('rated');
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
        Schema::dropIfExists('user_rates');
    }
};
