<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_id')->unsigned()->index()->nullable();
            $table->bigInteger('flat_id')->unsigned()->index()->nullable();
            $table->decimal('rent', 12, 2)->default(0);

            $table->timestamps();

            $table->softDeletes('deleted_at', 0);

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('flat_id')->references('id')->on('flats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
