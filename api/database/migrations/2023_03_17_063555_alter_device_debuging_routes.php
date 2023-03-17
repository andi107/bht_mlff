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
        Schema::table('debuging_routes', function($table) {
            $table->uuid('ftmlff_history_id')->nullable();
        });
        Schema::table('x_devices', function($table) {
            $table->uuid('uuid_geo_mlff_id')->default('00000000-0000-0000-0000-000000000000');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
