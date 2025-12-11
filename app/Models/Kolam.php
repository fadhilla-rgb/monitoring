<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kolam extends Model
{
    protected $fillable = [
        'nama',
        'lokasi',
        'luas'
    ];
    public function monitoring(){
        return $this->hasMany(Monitoring::class);
    }
    public function threshold(){
            return $this->hasOne(Threshold::class);
        }
}
