<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_student_languages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned()->index()->nullable();
            $table->string('language')->nullable();
            $table->string('score')->nullable();
            $table->string('language_documents',500)->nullable();
            $table->string('display_order')->nullable();
            $table->string('remarks')->nullable();
            $table->enum('status',['active','in_active'])->nullable();
            $table->bigInteger('created_by')->unsigned()->index()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->index()->nullable();
            $table->foreign('student_id')->references('id')->on('tbl_students')->onDelete('cascade');
            $table->foreign('created_by')->references('users_id')->on('tbl_users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('last_updated_by')->references('users_id')->on('tbl_users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_student_languages');
    }
}
