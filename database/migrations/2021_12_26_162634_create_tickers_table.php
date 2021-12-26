<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickers', function (Blueprint $table) {
            $table->id();
            $table->date('date_added');
            $table->double('vix');
            $table->double('bsesn');
            $table->double('ixic');
            $table->double('bvsp');
            $table->double('rut');
            $table->double('gspc');
            $table->double('sz');
            $table->double('gdaxi');
            $table->double('ss');
            $table->double('wheat');
            $table->double('wti');
            $table->double('cop');
            $table->double('gold');
            $table->double('tnx');
            $table->double('wheat_gold');
            $table->double('wti_gold');
            $table->double('cop_gold');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickers');
    }
}
