<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_guid');
            $table->string('item_name')->nullable();
            $table->string('item_group_id')->nullable();
            $table->string('item_uom')->nullable();
            $table->string('item_gst_applicable')->nullable();
            $table->string('item_gst_type')->nullable();
            $table->string('item_gst_rate_guid')->nullable();

            $table->enum('item_status', ['Active', 'Inactive'])->default('Active');

            $table->string('creator_id')->default('Admin');
            $table->dateTime('create_date_time')->nullable();
            $table->string('modifier_id')->default('Admin');
            $table->dateTime('modify_date_time')->nullable();

            // $table->dateTime('created_at')->nullable();
            // $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_items');
    }
}
