<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_histories', function (Blueprint $table) {
            $table->id();
            $table->string('method', 10);
            $table->text('url');
            $table->json('headers')->nullable();
            $table->longText('body')->nullable();
            $table->integer('response_status')->nullable();
            $table->longText('response_body')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_histories');
    }
};
