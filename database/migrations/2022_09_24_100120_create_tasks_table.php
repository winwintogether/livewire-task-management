<?php

use App\Enums\TaskStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('name');
            $table->mediumText('body')->nullable();
            $table->enum('status', array_column(TaskStatus::cases(), 'value'));
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
