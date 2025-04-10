<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { Schema::create('portfolio_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Adding company_id as a foreign key
            $table->json('media')->nullable(); // This will store media type and path/URL
            $table->string('project_title');
            $table->string('client_name');
            $table->string('country_location');
            $table->string('services_provided');
            $table->text('short_description');
            $table->date('engagement_start_date');
            $table->date('engagement_end_date')->nullable();
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
        Schema::dropIfExists('portfolio_items');
    }
}
