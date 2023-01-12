<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClassesIdAndGroupsIdOnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('product_class_id');
             $table->unsignedBigInteger('product_group_id');
            $table->foreign('product_class_id')->references('id')->on('product_classes')->onDelete('cascade');
            $table->foreign('product_group_id')->references('id')->on('product_groups')->onDelete('cascade');
            //  $table->foreignId('products_class_id')->constrained('products_class')->onDelete('set null');
            // $table->foreignId('products_group_id')->constrained('products_group')->onDelete('set null');
        
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropForeign('products_class_id_foreign');
            $table->dropForeign('products_group_id_foreign');
        });
    }
}
