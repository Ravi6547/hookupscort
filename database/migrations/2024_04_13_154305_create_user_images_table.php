<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_images', function (Blueprint $table) {
            $table->id(); // Primary key (auto-incrementing 'id' column)
            $table->unsignedBigInteger('user_id'); // Foreign key to 'users' table
            $table->string('image_path')->nullable(); // Path to the uploaded image
            $table->string('image_name')->nullable(); // Name of the uploaded image (optional)
            $table->timestamps(); // Created at and updated at timestamps
            
            // Define the foreign key constraint
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('user_images');
    }
}
