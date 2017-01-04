<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('st_instruct')->nullable();
            $table->string('requirements')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('noted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tutorials');
    }

}
