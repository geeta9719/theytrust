<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('logo')->nullable();
            $table->string('name')->nullable();
            $table->string('website')->nullable();
            $table->string('tagline')->nullable();
            $table->string('short_description')->nullable();
            $table->string('description')->nullable();
            $table->string('rate')->nullable();
            $table->string('budget')->nullable();
            $table->string('size')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->string('founded_at')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
