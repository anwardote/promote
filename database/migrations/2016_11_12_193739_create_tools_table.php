<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
            Schema::create('tools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->enum('supports', ['ALL VERSIONS', 'NA'])->default('ALL VERSIONS');
            $table->text('instructions')->nullable();
            $table->text('d_links')->nullable();
            $table->text('d_sizes')->nullable();
            $table->text('noted')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING', 'HIDDEN'])->default('PUBLISHED');
            $table->boolean('featured')->default(0);
            $table->integer('user_id')->unsigned();
            $table->timestamps();

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
        Schema::table('tools', function (Blueprint $table) {
            //
        });
    }

}
