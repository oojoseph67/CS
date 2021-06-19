<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fID');
            $table->string('role');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('personal_form')->default('NOTFILLLED');
            $table->string('documents')->default('NOTSUBMITTED');
            $table->string('preliminary_form')->default('NOTFILLLED');
            $table->string('clearance_form')->default('NOTFILLLED');
            $table->string('guarrantor_form')->default('NOTFILLLED');
            $table->string('acceptance_fee_status')->default('NOTPAID');
            $table->string('prospectus_fee_status')->default('NOTPAID');
            $table->string('department_fee_status')->default('NOTPAID');
            $table->string('school_fee_status')->default('NOTPAID');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
