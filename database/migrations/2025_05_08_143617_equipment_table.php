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
        Schema::create('equipment', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('room_id');
            // $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->string('name');
            $table->string('description');
            $table->string('srn');
            $table->string('acq');
            $table->integer('cost');
            $table->string('supp_info');
            $table->string('status');
            $table->string('condition');
            $table->timestamps();

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
