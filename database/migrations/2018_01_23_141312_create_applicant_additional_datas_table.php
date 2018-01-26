<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantAdditionalDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_additional_datas', function (Blueprint $table) {
            $table->integer('user_id');
            $table->timestamps();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('resume_path');
            $table->date('date_of_birth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicant_additional_datas');
    }
}
