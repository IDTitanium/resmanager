<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\ResourceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
    public function index() {
        $resources = Resource::get();
        foreach($resources as $resource) {
            if($resource->url && $resource->resourceType->name === 'snippet') {
                $resource->content = json_encode(Storage::get($resource->url));
            }
        }
        return view('index', ['resources' => $resources]);
    }
}
