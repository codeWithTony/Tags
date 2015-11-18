<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags__tag_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            
            $table->string('tag');
            $table->string('slug');

            $table->integer('tag_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['tag_id', 'locale']);
            $table->foreign('tag_id')->references('id')->on('tags__tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags__tag_translations');
    }
}
