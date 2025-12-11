<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    protected $fillable = [
        'kolam_id',
        'ph',
        'ketinggian_air',
        'suhu_air',
        'salinitas',
        'waktu_monitoring'
    ];
    public function kolam(){
        return $this->belongsTo(Kolam::class);
}
}