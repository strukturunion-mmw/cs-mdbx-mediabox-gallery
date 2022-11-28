<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arbeitspakete', function (Blueprint $table) {
            $table->id();
            $table->integer('import_id')->default(0);
            $table->string('name')->nullable();
            $table->string('termin')->default("31.12.2023");
            $table->string('kategorie')->nullable();
            $table->integer('budget')->default(0);
            $table->text('beschreibung')->nullable();
            $table->text('kommentar')->nullable();
            $table->integer('ds_aufwand_min')->default(0);
            $table->integer('ds_aufwand_max')->default(0);
            $table->integer('ds_aufwand')->default(0);
            $table->integer('bi_aufwand_min')->default(0);
            $table->integer('bi_aufwand_max')->default(0);
            $table->integer('bi_aufwand')->default(0);
            $table->integer('ri_aufwand_min')->default(0);
            $table->integer('ri_aufwand_max')->default(0);
            $table->integer('ri_aufwand')->default(0);
            $table->integer('ripa_aufwand_min')->default(0);
            $table->integer('ripa_aufwand_max')->default(0);
            $table->integer('ripa_aufwand')->default(0);
            $table->integer('quartal')->default(0);
            $table->string('chartcolor')->default("#666666");
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
        Schema::dropIfExists('arbeitspakete');
    }
};
