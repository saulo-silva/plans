<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('started_date')->nullable();
            $table->date('completed_date')->nullable();
            $table->decimal('total', 11, 2)->default(0);
            $table->string('destination'); // SAULO, RUTH, SOFIA
            $table->enum('type', ['DREAM', 'ACQUISITION', 'DEBT', 'WISH']);
            $table->enum('status', ['WAITING', 'IN_PROGRESS', 'PAUSE', 'COMPLETED', 'FAILED']);
            $table->enum('priority', ['HIGH', 'NORMAL', 'LOW'])->default('NORMAL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
