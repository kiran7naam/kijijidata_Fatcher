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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('ad_id');
            $table->bigInteger('dealer_id')->unsigned()->nullable();
            $table->foreign('dealer_id')->references('id')->on('dealers');
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('product_name');
            $table->longText('description')->nullable();
            $table->double('price',15,2)->default('0');
            $table->string('posted_date')->nullable();
            $table->string('valid_through')->nullable();
            $table->longText('other_details')->nullable();
            $table->longText('vehicle_details')->nullable();
            $table->longText('site_url')->nullable();
            $table->tinyInteger('is_like')->default('0')->comment="1=like,0=unlike";
            $table->tinyInteger('is_contacted')->default('0')->comment="1=contacted,0=not contacted";
            $table->tinyInteger('is_active')->default('1')->comment="1 active, 0 inactive";
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->softDeletes('deleted_at');
            $table->bigInteger('modified_by')->unsigned()->nullable();
            $table->foreign('modified_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
