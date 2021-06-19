<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->string('fID');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('gsm');
            // $table->timestamp('email_verified_at');
            $table->string('dob');
            $table->string('place_of_birth');
            $table->string('disability')->nullable();
            $table->string('health_challenges')->nullable();
            $table->string('sex');
            $table->string('marital_status');
            $table->string('title');
            $table->string('nationality');
            $table->string('religion');
            $table->string('state_of_origin');
            $table->string('lga')->nullable();
            $table->string('language');
            $table->string('name_of_guarrantor');
            $table->string('address_of_guarrantor');
            $table->string('gsm_of_guarrantor');
            $table->string('resident_address');
            $table->string('private_address');
            $table->string('permmanent_address');
            $table->string('landlord_name')->nullable();
            $table->string('landlord_address')->nullable();
            $table->string('landlord_gsm')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_address')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('employer_address')->nullable();
            $table->string('employer_gsm')->nullable();
            $table->string('sponsor_name');
            $table->string('sponsor_address');
            $table->string('sponsor_gsm');
            $table->string('name_of_next_of_kin');
            $table->string('address_of_next_of_kin');
            $table->string('gsm_of_next_of_kin');
            $table->string('email_of_next_of_kin');
            $table->string('level_of_entry');
            $table->string('mode_of_entry');
            $table->string('year_of_entry');
            $table->string('mode_of_study');
            $table->string('college');
            $table->string('dept');
            $table->string('mat_no')->nullable();
            $table->string('programme_of_study');
            $table->string('expected_graduation_year');
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
        Schema::dropIfExists('personal_information');
    }
}
