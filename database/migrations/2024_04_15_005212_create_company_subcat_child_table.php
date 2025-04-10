<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySubcatChildTable extends Migration
{
    public function up()
    {
        Schema::create('company_subcat_child', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('subcat_child_id');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('subcat_child_id')->references('id')->on('subcat_children')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('company_subcat_child');
    }
}
