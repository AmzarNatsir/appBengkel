<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiveModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tb_receive';
    protected $fillable = [
        'nomor_receive',
        'tanggal_receive',
        'ket_receive',
        'po_reff',
        'cara_bayar',
        'uang_muka',
        'biaya_lain',
        'ppn',
        'total',
        'total_net',
        'status',
        'user_at',
        'user_up',
        'user_del'
    ];
}
