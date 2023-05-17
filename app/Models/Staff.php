<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'tb_staff';

    protected $fillable = [
        'staff_id', 'staff_name', 'staff_addr', 'staff_rd',
        'staff_dept_id', 'staff_dept_name',
        'staff_dist', 'staff_prov', 'staff_subd', 'staff_post',
        'staff_phon', 'staff_mobi', 'staff_mail'
    ];
}
