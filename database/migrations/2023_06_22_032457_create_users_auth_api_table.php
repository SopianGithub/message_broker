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
        Schema::create('users_auth_api', function (Blueprint $table) {
            $table->id();
            $table->string('apps_name');
            $table->enum('type_auth', ['No Auth', 'Basic Auth', 'API Key', 'Bearer Token', 'JWT Bearer', 'Digest Auth', 'OAuth 1.0', 'OAuth 2.0', 'AWS Signature'])->default('No Auth');
            $table->json('credentials');
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
        Schema::dropIfExists('users_auth_api');
    }
};
