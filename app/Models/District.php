<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function thanas()
    {
        return $this->hasMany(Thana::class);
    }

    public function sites()
    {
        return $this->hasMany(ArcheologicalSite::class);
    }
}
