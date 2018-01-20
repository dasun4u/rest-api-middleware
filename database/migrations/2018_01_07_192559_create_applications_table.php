<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('approved')->default(0);
            $table->integer('approved_by');
            $table->integer('created_by');
            $table->string('username',50);
            $table->string('password',100);
            $table->string('production_key',200);
            $table->string('production_secret',200);
            $table->string('sandbox_key',200);
            $table->string('sandbox_secret',200);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
