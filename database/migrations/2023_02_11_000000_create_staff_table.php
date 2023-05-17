<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_staff', function (Blueprint $table) {
            $table->id();
            $table->integer('staff_id')->unsigned();
            $table->string('staff_name', 100)->nullable(false);
            $table->string('staff_addr', 255)->nullable(false);
            $table->string('staff_dept_id', 100)->nullable(false);
            $table->string('staff_dept_name', 100)->nullable(false);
            $table->string('staff_rd', 100)->nullable(false);
            $table->string('staff_dist', 100)->nullable(false);
            $table->string('staff_prov', 100)->nullable(false);
            $table->string('staff_subd', 100)->nullable(false);
            $table->string('staff_post', 10)->nullable(false);
            $table->string('staff_phon', 20)->nullable(false);
            $table->string('staff_mobi', 20)->nullable(false);
            $table->string('staff_mail', 100)->nullable(false);
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
        Schema::dropIfExists('tb_staff');
    }
}