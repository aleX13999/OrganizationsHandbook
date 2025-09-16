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
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->index(['address']);
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('activities')->onDelete('cascade');
            $table->string('name');
            $table->string('path')->default('/');
            $table->smallInteger('level')->default(0);
            $table->timestamps();
        });

        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->index(['name']);
            $table->timestamps();
        });

        Schema::create('organization_phones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->string('phone_number');
            $table->timestamps();
        });

        Schema::create('organization_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->foreignId('activity_id')->constrained()->onDelete('cascade');
            $table->unique(['organization_id', 'activity_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organization_activities');
        Schema::dropIfExists('organization_phones');
        Schema::dropIfExists('organizations');
        Schema::dropIfExists('activities');
        Schema::dropIfExists('buildings');
    }
};
