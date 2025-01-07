<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PpnMarginModel extends Model
{
    use HasFactory;
    protected $table = "set_ppn_margin_harga_jual";
    protected $fillable = [
        "ppn",
        "margin"
    ];
}
