<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('transactionable_id');
            $table->string('transactionable_type');
            $table->date('transaction_date');
            $table->enum('transaction_type', ['personal', 'loyalty'])->nullable();
            $table->bigInteger('amount');
            $table->string('payment_method');
            $table->timestamps();
            $table->index(['transactionable_id', 'transactionable_type']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
