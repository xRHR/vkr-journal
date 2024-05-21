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
        Schema::create('plan_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("plan_id")->constrained("plans")->onDelete("cascade");
            $table->string("title");
            $table->string("description")->nullable();
            $table->date("deadline")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_items');
    }
};
