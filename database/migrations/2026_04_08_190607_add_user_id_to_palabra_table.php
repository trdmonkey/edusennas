<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('palabra', function (Blueprint $table) {
            // 
            if (!Schema::hasColumn('palabra', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->after('id');
            }
            $table->index('user_id'); // busquedas rapidas pero para la tabla users viniendo de palabra
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('palabra', function (Blueprint $table) {
            //
        });
    }
};
