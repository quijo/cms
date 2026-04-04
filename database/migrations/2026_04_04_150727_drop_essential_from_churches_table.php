<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
return new class extends Migration {
    public function up(): void
    {
        Schema::table('churches', function (Blueprint $table) {
            $table->dropColumn('essential');
        });
    }

    public function down(): void
    {
        Schema::table('churches', function (Blueprint $table) {
            $table->enum('essential', ['nmi', 'ndi', 'nyi'])->default('nmi');
        });
    }
};