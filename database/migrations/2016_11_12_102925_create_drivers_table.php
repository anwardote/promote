<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('st_instruct')->nullable();
            $table->integer('driver_id')->unsigned();
            $table->string('driver_model')->nullable();
            $table->string('driver_type')->nullable();
            $table->string('supports')->nullable();
            $table->integer('tutorial_id')->unsigned()->nullable();
            $table->text('d_links')->nullable();
            $table->text('d_sizes')->nullable();
            $table->text('noted')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING', 'HIDDEN'])->default('PUBLISHED');
            $table->boolean('featured')->default(0);
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('driver_type')->references('id')->on('driver_types')
                    ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('driver_id')->references('id')->on('driver_names')
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
        Schema::dropIfExists('drivers');
    }

}
