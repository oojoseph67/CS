<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuarrantorFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guarrantor_forms', function (Blueprint $table) {
            $table->id();
            $table->string('fID');
            $table->string('name');
            $table->string('gsm');
            $table->string('email')->unique();
            $table->string('position');
            $table->string('title');
            $table->string('name_of_institution');
            $table->string('address_of_institution');
            $table->string('time_with_applicant');
            $table->string('capacity');
            $table->string('academic_performance');
            $table->string('academic_achievement');
            $table->string('research_potential');
            $table->string('originality');
            $table->string('judgment');
            $table->string('motivation');
            $table->string('ability_to_work_independently');
            $table->string('oral_expression');
            $table->string('written_expression');
            $table->string('potential');
            $table->string('reference_letter');
            $table->string('recommendation');
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
        Schema::dropIfExists('guarrantor_forms');
    }
}
