<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('house_id')->unsigned()->index()->nullable();
            $table->bigInteger('customer_id')->unsigned()->index()->nullable();
            $table->string('name', 50);
            $table->string('slug')->nullable();
            $table->decimal('rent', 12, 2)->default(0);
            $table->string('status', 50)->default('available');

            $table->timestamps();

            $table->softDeletes('deleted_at', 0);

            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
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
        Schema::dropIfExists('flats');
    }
}
