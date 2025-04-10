<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('project_type')->nullable();
            $table->string('project_title')->nullable();
            $table->string('company_type')->nullable();
            $table->string('cost_range')->nullable();
            $table->string('project_start')->nullable();
            $table->string('project_end')->nullable();
            $table->text('company_position')->nullable();
            $table->text('for_what_project')->nullable();
            $table->text('how_select')->nullable();
            $table->text('scope_of_work')->nullable();
            $table->text('team_composition')->nullable();
            $table->text('any_outcomes')->nullable();
            $table->text('how_effective')->nullable();
            $table->text('most impressive')->nullable();
            $table->text('area_of_improvements')->nullable();
            $table->string('quality')->nullable();
            $table->text('quality_review')->nullable();
            $table->string('scheduling')->nullable();
            $table->text('scheduling_review')->nullable();
            $table->string('cost')->nullable();
            $table->text('cost_review')->nullable();
            $table->string('refer_to_friend')->nullable();
            $table->text('refer_to_friend_review')->nullable();
            $table->string('overall_rating')->nullable();
            $table->text('overall_rating_review')->nullable();
            $table->string('full_name')->nullable();
            $table->string('attribution')->nullable();
            $table->string('position_title')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_size')->nullable();
            $table->string('city_country')->nullable();
            $table->string('company_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('company_url')->nullable();
            $table->tinyInteger('status')->default('1');
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
        Schema::dropIfExists('company_reviews');
    }
}
