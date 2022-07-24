<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Resource extends Model
{
    use HasFactory;

    protected $with = ['resourceType'];

    protected $guarded = ['id'];

    public function resourceType() {
        return $this->belongsTo(ResourceType::class);
    }
}
