<?php

/*
We have a (posts) table, we want to add a column (description) to it.
Simply (you know this way) you can inside (2024_09_19_040831_create_posts_table.php), 
add the column and then do the fresh command. BUT, this resets all tables
and lose existing data.

Fa lw msh 3yza kda, create a new migration to add the column: You can
use the make:migration command to create a new migration file that will 
only add the column to the existing table.
Command: php artisan make:migration add_description_column_to_posts_table
1- This command created this file.
2- Define the new column you want to add
3- php artisan migrate (not fresh)
In posts table in db, description column is added with no data loss
*/



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // A new column I want to add
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
};
