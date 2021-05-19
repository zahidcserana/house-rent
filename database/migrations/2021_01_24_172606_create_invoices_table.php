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
            $table->bigInteger('customer_id')->unsigned()->index()->nullable();
            $table->string('direct_url')->nullable();
            $table->date('date')->nullable();
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('additional_cost', 12, 2)->default(0);
            $table->decimal('payable_amount', 12, 2)->default(0);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->string('status', 50)->nullable();
            $table->string('comments')->nullable();

            $table->timestamps();

            $table->softDeletes('deleted_at', 0);

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
