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
            $table->unsignedBigInteger('user_id')->unique();
            $table->timestamps();
            $table->unsignedInteger('max_calories')->default(2000);

            $table->unsignedDouble('max_total_fat')->default(70);
            $table->unsignedDouble('med_total_fat_boundary')->default(3);
            $table->unsignedDouble('high_total_fat_boundary')->default(17.5);
            
            $table->unsignedDouble('max_saturated_fat')->default(20);
            $table->unsignedDouble('med_saturated_fat_boundary')->default(1.5);
            $table->unsignedDouble('high_saturated_fat_boundary')->default(5);
            
            $table->unsignedDouble('max_total_sugar')->default(90);
            $table->unsignedDouble('med_total_sugar_boundary')->default(5);
            $table->unsignedDouble('high_total_sugar_boundary')->default(22.5);
            
            $table->unsignedDouble('max_salt')->default(6);
            $table->unsignedDouble('med_salt_boundary')->default(0.3);
            $table->unsignedDouble('high_salt_boundary')->default(1.5);

            $table->primary(['user_id']);
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
