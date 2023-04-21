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
        Schema::table('x_devices', function($table) {
            $table->integer('fnoutfromtoll')->default(0);
            $table->index([
                'fnoutfromtoll'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('x_devices', function($table) {
            $table->dropColumn('fnoutoftoll');
        });
    }
};
