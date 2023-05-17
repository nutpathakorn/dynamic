<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_id', 45)->nullable(false);
            $table->string('company_name', 100)->nullable(false);
            $table->string('company_addr', 255)->nullable(false);
            $table->string('company_rd', 100)->nullable(false);
            $table->string('company_dist', 100)->nullable(false);
            $table->string('company_prov', 100)->nullable(false);
            $table->string('company_subd', 100)->nullable(false);
            $table->string('company_post', 10)->nullable(false);
            $table->string('company_phon', 20)->nullable(false);
            $table->string('company_mobi', 20)->nullable(false);
            $table->string('company_mail', 100)->nullable(false);
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
        Schema::dropIfExists('tb_companies');
    }
}