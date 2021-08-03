<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClearanceStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearance_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('fID');
            $table->string('personal_form')->nullable()->default('PENDING REVIEW');
            $table->string('document')->nullable()->default('PENDING REVIEW');
            $table->string('preliminary_form')->nullable()->default('PENDING REVIEW');
            $table->string('clearance_form')->nullable()->default('PENDING REVIEW');
            $table->string('guarrantor_form')->nullable()->default('PENDING REVIEW');
            $table->string('hod_recommendation')->nullable();
            $table->string('pg_officer_recommendation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clearance_statuses');
    }
}
