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
        Schema::create('plan_progress', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('plan_id');
            $table->foreignId('user_id');
            $table->foreignId('plan_item_id');
            $table->boolean('done')->default(false);
            $table->boolean('confirmed_done')->default(false);
            $table->date('done_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_progress');
    }
};
