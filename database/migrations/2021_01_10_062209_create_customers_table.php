<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->unique();
            $table->string('nid')->nullable();
            $table->string('address')->nullable();
            $table->decimal('account_balance', 12, 2)->default(0);
            $table->decimal('advance_balance', 12, 2)->default(0);
            $table->enum('status', ['ACTIVE', 'INACTIVE'])->default('ACTIVE');

            $table->timestamps();

            $table->softDeletes('deleted_at', 0);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
