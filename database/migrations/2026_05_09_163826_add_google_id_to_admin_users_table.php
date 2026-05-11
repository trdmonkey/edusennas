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
        Schema::table('admin_users', function (Blueprint $table) {
            // buehno vamos a agregar el atributo google_id a la tabla admin_users y lo dejamos que permita null porque pueden loguearse de la forma tradicional.
            $table->string('google_id')->nullable()->after('email');

            // aghora para el password tambien lo ponemos nullable por si entra con la cuenta google
            // | Field          | Type             | Null | Key | Default | Extra
            // | password       | varchar(255)     | NO   |     | NULL    |
            $table->string('password')->nullable()->change();

            // el password 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_users', function (Blueprint $table) {
            // 
            $table->dropColumn('google_id');
            $table->string('password')->nullable(false)->change();
        });
    }
};
