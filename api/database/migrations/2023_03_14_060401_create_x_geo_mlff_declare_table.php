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
        Schema::create('x_geo_mlff_declare', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->string('ftgeo_name');
            // $table->string('ftaddress');
            $table->integer('fntype');
            $table->uuid('uuid_x_gate_point_id');
            $table->integer('fnstatus');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->index([
                'id',
                'fntype',
                'created_at',
                'updated_at'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('x_geo_mlff_declare');
    }
};
