<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('task_id');
            // $table->primary(['tag_id', 'task_id']);

            $table->index('tag_id', 'tag_task_tag_idx');
            $table->index('task_id', 'tag_task_task_idx');

            $table->foreign('tag_id', 'tag_task_tag_fk')->on('tags')->references('id');
            $table->foreign('task_id', 'tag_task_task_fk')->on('tasks')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_tasks');
    }
}
