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
        Schema::create('x_devices', function (Blueprint $table) {
            $table->string('ftdevice_id')->primary();
            $table->string('ftname',100);
            $table->string('fttype',100)->nullable();
            $table->string('ftvehicle_id')->unique();
            $table->string('ftvehicle_name');
            $table->string('ftdescription',255)->nullable();
            $table->float('fflat')->default(0);
            $table->float('fflon')->default(0);
            $table->integer('fngeo_status')->default(0);
            $table->integer('fngeo_current_id')->default(0);
            $table->integer('fngeo_chkpoint')->default(0);
            
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->float('ffdirect')->default(0);
            $table->float('ffalt')->default(0);
            $table->boolean('fbignition')->default(0);
            $table->float("ffbattery")->default(0);
            $table->integer('fnstatus');

            $table->index([
                'ftdevice_id',
                'ftname',
                'fttype',
                'fngeo_status',
                'fngeo_current_id',
                'fngeo_chkpoint',
                'created_at',
                'updated_at',
                'ftvehicle_id',
                'ftvehicle_name',
                'ffdirect',
                'ffalt',
                'fbignition',
                'ffbattery',
                'fnstatus'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('x_devices');
    }
};
