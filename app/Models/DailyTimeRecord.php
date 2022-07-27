<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTimeRecord extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'dailytimerecord_logs';
    protected $fillable = [
        'date',
        'email',
        'name',
        'period',
        'image_path',
        'created_at',
        'updated_at',
    ];

}
