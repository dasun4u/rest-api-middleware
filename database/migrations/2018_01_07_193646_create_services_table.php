<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->tinyInteger('approved')->default(0);
            $table->tinyInteger('active')->default(0);
            $table->string('context',200);
            $table->string('production_uri',200);
            $table->string('sandbox_uri',200);
            $table->string('method',10);
            $table->string('description',1000)->nullable();
            $table->integer('service_group_id');
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
        Schema::dropIfExists('services');
    }
}
