<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'tb_companies';

    protected $fillable = [
        'company_id', 'company_name', 'company_addr', 'company_rd',
        'company_dist', 'company_prov', 'company_subd', 'company_post',
        'company_phon', 'company_mobi', 'company_mail'
    ];
}
