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
        Schema::create('x_geo_toll_route_det', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('x_geo_toll_route_id');
            $table->float('fflat');
            $table->float('fflon');
            $table->integer("fnindex");
            $table->integer('fnchkpoint')->default(0);

            $table->index([
                'id',
                'x_geo_toll_route_id',
                'fflat',
                'fflon',
                'fnchkpoint'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('x_geo_toll_route_det');
    }
};
