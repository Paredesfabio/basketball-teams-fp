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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('position',4);
            $table->timestamp('birth_date');
            $table->timestamp('draft_date');
            $table->string('height');
            $table->string('weight');
            $table->string('school');
            $table->string('image')->nullable();
            $table->mediumText('about_me')->nullable();
            $table->foreignId('player_id')->constrained('players')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            $table->foreignId('country_id')->constrained('countries');
            $table->timestamp("created_at")->useCurrent();
            $table->timestamp("updated_at")->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
};
