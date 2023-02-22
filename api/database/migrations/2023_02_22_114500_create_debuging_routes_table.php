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
        Schema::create('debuging_routes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('ftdevice_id');
            $table->float('fflat');
            $table->float('fflon');
            $table->bigInteger('fngeo_id')->default(0);
            $table->integer('fngeo_chkpoint')->default(0);
            $table->timestamp('created_at');

            $table->string('fttype',10)->nullable();
            $table->float('ffaccuracy_cep')->nullable();
            $table->float('ffdirection')->nullable();
            $table->float('ffspeed')->nullable();
            $table->float('ffbattery')->nullable();
            $table->integer('fnsattelite')->nullable();
            $table->float('ffaltitude')->nullable();
            $table->index([
                'id',
                'fflat',
                'fflon',
                'fngeo_id',
                'created_at',
                'fttype',
                'ffaccuracy_cep',
                'ffdirection',
                'ffspeed',
                'ffbattery',
                'fnsattelite',
                'ffaltitude'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debuging_routes');
    }
};
