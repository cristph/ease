<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advice', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userEmail');
            $table->string('userName');
            $table->string('adviserEmail');
            $table->string('adviserName');
            $table->integer('adviserType');
            $table->text('content');
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
        Schema::drop('advice');
    }
}
