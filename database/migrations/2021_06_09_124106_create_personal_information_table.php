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
            $table->date('dob');
            $table->string('place_of_birth')->nullable();
            $table->string('disability')->nullable();
            $table->string('health_challenges')->nullable();
            $table->string('sex')->nullable();
            $table->string('martial_status')->nullable();
            $table->string('title')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('state_of_origin')->nullable();
            $table->string('lga')->nullable();
            $table->string('language')->nullable();
            $table->string('name_of_guarrantor')->nullable();
            $table->string('address_of_guarrantor')->nullable();
            $table->string('gsm_of_guarrantor')->nullable();
            $table->string('resident_address')->nullable();
            $table->string('private_address')->nullable();
            $table->string('permmanent_address')->nullable();
            $table->string('landlord_name')->nullable();
            $table->string('landlord_address')->nullable();
            $table->string('landlord_gsm')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('parent_address')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('employer_address')->nullable();
            $table->string('employer_gsm')->nullable();
            $table->string('sponsor_name')->nullable();
            $table->string('sponsor_address')->nullable();
            $table->string('sponsor_gsm')->nullable();
            $table->string('name_of_next_of_kin')->nullable();
            $table->string('address_of_next_of_kin')->nullable();
            $table->string('gsm_of_next_of_kin')->nullable();
            $table->string('email_of_next_of_kin')->nullable();
            $table->string('level_of_entry')->nullable();
            $table->string('mode_of_entry')->nullable();
            $table->date('year_of_entry')->nullable();
            $table->string('mode_of_study')->nullable();
            $table->string('college')->nullable();
            $table->string('dept')->nullable();
            $table->string('mat_no')->nullable();
            $table->string('programme_of_study')->nullable();
            $table->string('expected_graduation_year')->nullable();
            $table->string('qualification_on_entry')->nullable();
            $table->string('qualification_currently')->nullable();
            $table->string('institution_attended')->nullable();
            $table->date('institution_attended_date')->nullable();
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
