<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_api', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apps_id_send')->references('id')->on('users_auth_api')->onDelete('cascade');
            $table->string('send_to');
            $table->string('id_apps');
            $table->string('url');
            $table->enum('method', ['GET', 'POST', 'PUT', 'DELETE']);
            $table->json('payload');
            $table->json('response')->nullable();
            $table->boolean('is_done')->default(false);
            $table->boolean('is_retry')->default(false);
            $table->boolean('is_feedback')->default(false);
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
        Schema::dropIfExists('logs_api');
    }
};
