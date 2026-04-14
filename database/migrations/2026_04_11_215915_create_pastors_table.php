<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pastors', function (Blueprint $table) {
            $table->id();

            $table->string('first_name');
            $table->string('last_name');

            // Role (pas, edu, etc.)
            $table->enum('role', ['pas', 'edu', 'admin', 'other'])->nullable();

            // Ordination / License
            $table->enum('status', ['licensed', 'ordained', 'deacon', 'local'])->nullable();

            // Church assignment (optional)
            $table->foreignId('church_id')->nullable()->constrained()->nullOnDelete();

            // Profile
            $table->string('photo')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable();

            // Extra info
            $table->date('date_of_birth')->nullable();
            $table->text('address')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pastors');
    }
};