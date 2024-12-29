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
        Schema::create('challenge_groups_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('challenge_group_id')->constrained('challenge_groups');
            $table->foreignId('user_id')->constrained('users');
            $table->foreign(['challenge_group_id', 'user_id'])
                ->references(['challenge_group_id', 'user_id'])
                ->on('challenge_groups_users')
                ->onDelete('cascade');
            $table->string('description', 140);
            $table->string('image', 255);
            $table->smallInteger('score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('challenge_groups_posts');
    }
};
