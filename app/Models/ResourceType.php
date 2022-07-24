<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceType extends Model
{
    use HasFactory;

    const DOCUMENT = 'document';
    const LINK = 'link';
    const SNIPPET = 'snippet';

    public function resources() {
        return $this->hasMany(Resource::class);
    }
}
