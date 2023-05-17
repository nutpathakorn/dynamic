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
        Schema::create('tb_companies_user', function (Blueprint $table) {
            $table->id();
            $table->string('company_owner_id', 45)->nullable(false);
            $table->string('company_user_cid', 100)->nullable(false);
            $table->string('company_user_name', 255)->nullable(false);
            $table->integer('company_user_addr1_id')->nullable(false);
            $table->integer('company_user_addr2_id')->nullable(false);
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
        Schema::dropIfExists('tb_companies_user');
    }
};
