<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('fID');
            $table->string('passport');
            $table->string('o/l_certificate');
            $table->string('o/l_card');
            $table->string('ufd/hnd_certificate');
            $table->string('rhd/diploma_certificate');
            $table->string('nysc/exemption_certificate');
            $table->string('clearnce_certificate_fupre')->nullable();
            $table->string('birth_certificate');
            $table->string('state_of_origin_certificate');
            $table->string('marriage_certificate')->nullable();
            $table->string('admission_letter');
            $table->string('application_form');
            $table->string('transcript')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
