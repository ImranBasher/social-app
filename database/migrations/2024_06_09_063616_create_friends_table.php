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
        Schema::create('friends', function (Blueprint $table) {
            $table->id();

            $table->foreignId('to_user')->nullable()->constrained('users');
            $table->foreignId('from_user')->nullable()->constrained('users');

            $table->enum('status',[1,2])->comment('1 = accepted friend request, 2 = panding friend request');

            $table->foreignId('created_by_id')->nullable()->constrained('users');
            $table->foreignId('updated_by_id')->nullable()->constrained('users');
            $table->foreignId('deleted_by_id')->nullable()->constrained('users');
            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('friends',function(Blueprint $table){
    
            $table->dropForeign(['to_user']);
            $table->dropForeign(['from_user']);

            $table->dropForeign(['created_by_id']);
            $table->dropForeign(['updated_by_id']);
            $table->dropForeign(['deleted_by_id']);
        });


        Schema::dropIfExists('friends');
    }
};
