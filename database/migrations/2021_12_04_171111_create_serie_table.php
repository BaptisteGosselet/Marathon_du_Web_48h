<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->text('resume');
            $table->string('langue');
            $table->decimal('note', 4, 2)->nullable();
            $table->string('statut', 64);
            $table->date('premiere');
            $table->string('genre');
            $table->string('urlImage');
            $table->text('avis')->nullable();
            $table->text('urlAvis')->nullable();
//            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serie');
    }
}
