<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');

            $table->foreignId('item_id');
            $table->foreign('item_id')->references('id')
                ->on('items')->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('originator_id');
            $table->foreign('originator_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('assignee_id');
            $table->foreign('assignee_id')->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
