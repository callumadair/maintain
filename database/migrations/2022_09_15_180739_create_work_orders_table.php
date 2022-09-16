<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('requestee_id');
            $table->foreign('requestee_id')->references('id')
                ->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('approvee_id');
            $table->foreign('aprovee_id')->references('id')
                ->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->text('description')->nullable();
            $table->date('date_wanted')->nullable();

            $table->decimal('total_materials', 10)->nullable();
            $table->decimal('total_labour', 10)->nullable();
            $table->decimal('total_cost', 10)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
};
