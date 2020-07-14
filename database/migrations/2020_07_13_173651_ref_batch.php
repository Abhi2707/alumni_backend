<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RefBatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ref_batch', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('batch')->unique();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
        for ($i=1980;$i<=2020;$i++){
            $batch[] = ["batch" => $i];
        }
        $db = \Illuminate\Support\Facades\DB::table('ref_batch')->insert($batch);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
