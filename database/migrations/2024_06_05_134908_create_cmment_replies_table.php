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
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->id();
            $table->text('comment_reply_body');
            $table->foreignId('post_id')->constrained('posts');
            $table->foreignId('post_comment_id')->constrained('post_comments');
            $table->foreignId('user_id')->constrained('users');

            $table->boolean('is_active')->default(1);

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

        Schema::table('comment_replies',function(Blueprint $table){
    
            $table->dropForeign(['post_id']);
            $table->dropForeign(['post_comment_id']);
            $table->dropForeign(['user_id']);

            $table->dropForeign(['created_by_id']);
            $table->dropForeign(['updated_by_id']);
            $table->dropForeign(['deleted_by_id']);
        });

        Schema::dropIfExists('comment_replies');
    }
};
