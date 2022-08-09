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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image_path');

            $table->foreignId('item_id')->nullable();
            $table->foreign('item_id')->references('id')
                ->on('items')->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('issue_id')->nullable();
            $table->foreign('issue_id')->references('id')
                ->on('issues')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('images');
    }
};
