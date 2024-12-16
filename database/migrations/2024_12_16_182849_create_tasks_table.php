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
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('catogry_id')->nullable();
            $table->foreign('catogry_id')->references('id')->on('catogries')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->text('title')->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('status')->nullable()->comment('0 = pending, 1 = in progress, 2 = completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
