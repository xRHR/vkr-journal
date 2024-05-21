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
        DB::table('statuses')->insert(
            array(
                'title' => 'Администратор',
            )
            );
        DB::table('statuses')->insert(
            array(
                'title' => 'Студент',
            )
            );
        DB::table('statuses')->insert(
            array(
                'title' => 'Научный руководитель',
            )
            );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('statuses', function (Blueprint $table) {
            $table->truncate();
        });
    }
};
