<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('verzuim', function (Blueprint $table) {
            $table->id();
            $table->date('datum')->nullable();
            $table->string('groep_code')->nullable();
            $table->string('leeftijd_op_1_10')->nullable();
            $table->string('naam_docent')->nullable();
            $table->string('student_naam')->nullable();
            $table->string('studentnummer')->nullable();
            $table->string('vak')->nullable();
            $table->float('percentage_aanwezig')->nullable();
            $table->float('percentage_geoorloofd_afwezig')->nullable();
            $table->float('percentage_ongeoorloofd_afwezig')->nullable();
            $table->float('percentage_niet_geregistreerde_lestijd')->nullable();
            $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verzuim');
    }
};
