<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('churches', function (Blueprint $table) {
            $table->id();
            
            $table->string('name'); // Church name
            $table->string('church_number')->unique();
            
            $table->enum('status', ['active', 'inactive', 'mission', 'organized'])->default('active');
            
            $table->date('start_date')->nullable();
            $table->string('contact_address')->nullable();

        
            

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('churches');
    }
};