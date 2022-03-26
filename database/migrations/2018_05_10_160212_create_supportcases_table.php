<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportcasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supportcases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('Sonstiges');
            $table->string('casetype')->default('Support');
            $table->string('supporter');
            $table->string('spieler');
            $table->string('scn');
            $table->text('geschehen');
            $table->text('Beweise')->default('<p></p>');
            $table->text('Entscheidung')->default('<p></p>');
            $table->enum('done', ['YES', 'NO'])->default('NO');
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
        Schema::dropIfExists('supportcases');
    }
}
