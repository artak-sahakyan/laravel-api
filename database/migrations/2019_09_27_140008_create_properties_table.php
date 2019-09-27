<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->unsignedInteger('property_type_id');
            $table->unsignedInteger('status_id');
            $table->boolean('for_sale')->default(0);
            $table->boolean('for_rent')->default(0);
            $table->unsignedInteger('project_id');
            $table->unsignedInteger('region_id');


            $table->foreign('property_type_id')
                ->references('id')
                ->on('property_types');
            $table->foreign('status_id')
                ->references('id')
                ->on('statuses');
            $table->foreign('region_id')
                ->references('id')
                ->on('regions');
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
