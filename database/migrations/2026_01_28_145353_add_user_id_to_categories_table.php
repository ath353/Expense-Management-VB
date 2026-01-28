<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->nullable()->constrained()->onDelete('cascade');
        });
        
        // Gán tất cả categories cũ cho user đầu tiên (hoặc xóa nếu không có user)
        $firstUserId = DB::table('users')->first()?->id;
        if ($firstUserId) {
            DB::table('categories')->whereNull('user_id')->update(['user_id' => $firstUserId]);
        }
        
        // Sau khi gán xong, đặt NOT NULL
        Schema::table('categories', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
