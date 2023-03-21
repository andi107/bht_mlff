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
        
        Schema::table('x_geo_mlff_declare', function($table) {
            $table->uuid('uuid_x_gate_point_id');
            $table->index([
                'uuid_x_gate_point_id'
            ]);
            $table->dropColumn('ftaddress');
            $table->dropColumn('ftgeo_name');
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
