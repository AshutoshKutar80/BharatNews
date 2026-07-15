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
        Schema::create('news', function (Blueprint $table) {

            $table->id();

            // Relationships
            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->foreignId('subcategory_id')
                ->nullable()
                ->constrained('sub_categories')
                ->nullOnDelete();

            $table->foreignId('author_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Basic Information
            $table->string('title');
            $table->string('slug')->unique();

            $table->text('short_description')->nullable();
            $table->longText('content');

            // Media
            $table->string('featured_image')->nullable();

            // News Details
            $table->string('source')->nullable();
            $table->string('location')->nullable();
            $table->string('tags')->nullable();

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            // Status
            $table->enum('status', ['draft', 'published'])->default('draft');

            $table->boolean('is_breaking')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_trending')->default(false);

            // Statistics
            $table->unsignedBigInteger('views')->default(0);

            // Publish Date
            $table->timestamp('published_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('category_id');
            $table->index('subcategory_id');
            $table->index('author_id');
            $table->index('status');
            $table->index('published_at');
            $table->index('is_breaking');
            $table->index('is_featured');
            $table->index('is_trending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
