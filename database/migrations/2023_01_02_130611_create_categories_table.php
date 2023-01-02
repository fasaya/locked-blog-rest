<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    //   table.increments('id')
    //   table.integer('parent_id').nullable()
    //   table.string('slug').notNullable()
    //   table.string('title').nullable()
    //   table.text('content').nullable()
    //   table.string('meta_title').nullable()

    //   /**
    //    * Uses timestamptz for PostgreSQL and DATETIME2 for MSSQL
    //    */
    //   table.timestamp('created_at', { useTz: true })
    //   table.timestamp('updated_at', { useTz: true })

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
