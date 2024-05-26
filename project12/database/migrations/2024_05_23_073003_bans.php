<?php

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
        Schema::create('bans', function (Blueprint $table) {
            $table->unsignedBigInteger('users_id'); // Make sure it's unsigned to match 'id' in users table
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade'); // Define foreign key constraint
            $table->primary('users_id'); // Set as primary key
            $table->integer('is_banned');
            $table->dateTime('begin_ban');
            $table->dateTime('end_ban')->default(DB::raw('DATE_ADD(NOW(), INTERVAL 3 MONTH)'));
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bans'); // Corrected table name
    }
};
