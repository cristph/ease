<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdviceapplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adviceapply', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userEmail');
            $table->string('userName');
            $table->string('adviserEmail');
            $table->string('adviserName');
            $table->integer('adviserType');
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
        Schema::drop('adviceapply');
    }
}
