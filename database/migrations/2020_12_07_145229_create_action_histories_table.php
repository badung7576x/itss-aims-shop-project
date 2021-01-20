<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('action_type')->nullable();
            $table->string('descriptions')->nullable();
            $table->dateTime('activated_at')->nullable();
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
        Schema::dropIfExists('action_histories');
    }
}
