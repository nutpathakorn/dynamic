<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_companies_addr2', function (Blueprint $table) {
            $table->id();
            $table->string('company_owner_id', 45)->nullable(false);
            $table->string('company_addr2_name', 100)->nullable(false);
            $table->string('company_addr2_addr', 255)->nullable(false);
            $table->integer('company_addr2_province_id')->nullable(false);
            $table->string('company_addr2_province', 100)->nullable(false);
            $table->integer('company_addr2_district_id')->nullable(false);
            $table->string('company_addr2_district', 100)->nullable(false);
            $table->integer('company_addr2_subdistrict_id')->nullable(false);
            $table->string('company_addr2_subdistrict', 100)->nullable(false);
            $table->string('company_addr2_post', 100)->nullable(false);
            $table->string('company_addr2_condition', 255)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_user_addr2');
    }
};
