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
            $table->string('ftdevice_name',100);

            $table->string('ftasset_id',50);
            $table->string('ftasset_name',100);
            // $table->string('ftasset_type',100);
            $table->string('ftasset_description',255)->nullable();

            $table->integer('fncategory');
            $table->uuid('uuid_customer_id')->nullable();
            // $table->string('ftcustomer_name',100);
            $table->uuid('uuid_geo_id')->default('00000000-0000-0000-0000-000000000000');
            $table->float('fflat')->default(0);
            $table->float('fflon')->default(0);
            $table->float('ffdirect')->default(0);
            $table->float('ffalt')->default(0);
            $table->boolean('fbignition')->default(0);
            $table->float("ffbattery")->default(0);
            $table->integer('fnstatus');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->uuid('uuid_geo_mlff_id')->default('00000000-0000-0000-0000-000000000000');
            $table->index([
                'ftdevice_id',
                'ftdevice_name',
                'ftasset_id',
                'uuid_geo_id',
                'fncategory',
                'uuid_customer_id',
                'fflat',
                'fflon',
                'ffdirect',
                'ffalt',
                'fbignition',
                'ffbattery',
                'fnstatus',
                'created_at',
                'updated_at',
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
