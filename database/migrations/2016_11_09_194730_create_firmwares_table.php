<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirmwaresTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('firmwares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fcategory_id')->unsigned();
            $table->text('st_instruct')->nullable();
            $table->integer('device_id')->unsigned();
            $table->string('device_model')->nullable();
            $table->string('device_version')->nullable();
            $table->integer('tutorial_id')->unsigned()->nullable();
            $table->string('country_id')->nullable();
            $table->text('d_links')->nullable();
            $table->text('d_sizes')->nullable();
            $table->text('noted')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING', 'HIDDEN'])->default('PUBLISHED');
            $table->boolean('featured')->default(0);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('fcategory_id')->references('id')->on('fcategories')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('device_id')->references('id')->on('devices')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tutorial_id')->references('id')->on('tutorials');
            $table->foreign('user_id')->references('id')->on('users')
                    ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('firmwares');
    }

}
