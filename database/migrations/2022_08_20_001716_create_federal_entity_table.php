<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFederalEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('federal_entity', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('key')->nullable();
            $table->String('name')->nullable();
            $table->String('code')->nullable();
            $table->foreignId('location_id')->constrained('location')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('federal_entity');
    }
}
