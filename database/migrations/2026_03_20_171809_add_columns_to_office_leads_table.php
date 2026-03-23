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
        Schema::table('office_leads', function (Blueprint $table) {
            $table->string('client_mobile2')->nullable();
            $table->string('budget')->nullable();
            $table->string('website')->nullable();
            $table->string('location')->nullable();
            $table->json('extra_column')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('office_leads', function (Blueprint $table) {
            $table->dropColumn(['client_mobile2', 'budget', 'website', 'location', 'extra_column']);
        });
    }
};
