<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
public function up(): void
{
    Schema::create('employees', function (\Illuminate\Database\Schema\Blueprint $table) {
        $table->id();
        $table->string('code')->unique();
        $table->string('full_name');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->string('position')->nullable();
        $table->string('department')->nullable();
        $table->date('hired_at')->nullable();
        $table->timestamps();
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
