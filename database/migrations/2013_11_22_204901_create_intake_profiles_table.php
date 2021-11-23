<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntakeProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intake_profiles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('max_calories');
            $table->unsignedDouble('max_total_fat');
            $table->unsignedDouble('max_saturated_fat');
            $table->unsignedDouble('max_total_sugar');
            $table->unsignedDouble('max_salt');
            $table->unsignedBigInteger('user_id')->unique();

            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intake_profiles');
    }
}
