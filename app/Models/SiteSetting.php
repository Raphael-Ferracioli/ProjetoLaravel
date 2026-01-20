<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'setting_key',
        'setting_value',
        'setting_type',
        'description'
    ];
    
    public $timestamps = false;
    
    protected $dates = ['updated_at'];
}
