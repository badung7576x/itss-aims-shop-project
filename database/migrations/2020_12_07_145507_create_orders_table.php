<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no');
            $table->integer('user_id');
            $table->integer('shipping_info_id');
            $table->string('note')->nullable();
            $table->integer('shipping_amount')->nullable();
            $table->integer('order_amount')->nullable();
            $table->integer('payment_type')->nullable();
            $table->integer('shipping_type')->nullable();
            $table->integer('payment_status')->nullable();
            $table->integer('order_status')->nullable();
            $table->dateTime('ordered_at')->default(\DB::raw('CURRENT_TIMESTAMP'));;
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
        Schema::dropIfExists('orders');
    }
}
