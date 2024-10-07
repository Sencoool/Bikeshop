<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->string('order_number', 30); //เลขที่ใบสั่งซื้อ
            $table->string('order_name', 50); //ชื่อสินค้า
            $table->integer('price'); //ราคาต่อหน่วย
            $table->string('qty', 10); //จำนวน
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('order');
            $table->foreign('order_number')->references('order_number')->on('order')->onDelete('cascade');
           // ->onDelete('cascade'): กำหนดให้เมื่อมีการลบรายการในตาราง order (ซึ่งมี order_number ที่ถูกอ้างอิง) 
           // ข้อมูลที่เกี่ยวข้องในตาราง order_detail จะถูกลบออกโดยอัตโนมัติด้วย (cascade deletion)
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_detail');
    }
}
