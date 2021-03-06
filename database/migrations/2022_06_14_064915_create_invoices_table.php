<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('shipping_address');
            $table->string('shipping_phone');
            $table->integer('type')->default(0); //0 hđ bán, 1 phiếu nhập
            $table->integer('status')->default(0); # 0 chờ xác nhận, 1 đang vận chuyển, 2 đã nhận hàng
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
