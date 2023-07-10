<?php

use App\Models\Inscription;
use App\Models\DisciplineClasse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->float("value");
            $table->foreignIdFor(DisciplineClasse::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Inscription::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->dropForeignIdFor(DisciplineClasse::class);
            $table->dropForeignIdFor(Inscription::class);
        });
        Schema::dropIfExists('marks');
    }
};
