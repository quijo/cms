<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('givings', function (Blueprint $table) {
            $table->id();

            // Link to member
            $table->foreignId('member_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Optional: who recorded the giving
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Giving details
            $table->decimal('amount', 10, 2);
            $table->enum('type', [
                'tithesAndOffering',
                'essentials',
                'districtBudget',
                'education',
                'mission',
                'WEF',
                'donation',
                'others'
            ])->default('tithesAndOffering');

            $table->date('giving_date');

            $table->text('notes')->nullable();

            // 🧾 OR Number (Official Receipt)
            $table->string('or_number')->unique();

            // ✅ Approval system
            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('givings');
    }
};