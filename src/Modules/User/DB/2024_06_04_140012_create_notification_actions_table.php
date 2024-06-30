<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notification_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\Modules\User\Models\User::class)->constrained()->onDelete('cascade');
            $table->foreignUuid('notification_id')->constrained('notifications');
            $table->string('type')->default(\App\Enum\NotifyType::READ);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_actions');
    }
};
