<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLinkRequest;
use App\Http\Requests\CreatePdfRequest;
use App\Http\Requests\CreateResourceRequest;
use App\Http\Requests\CreateSnippetRequest;
use App\Http\Requests\EditRequest;
use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\ResourceType;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
        $resources = Resource::get();
        return view('admin.admin', ['resources' => $resources]);
    }

    public function create(CreateResourceRequest $request) {
        $type = $request->type;
        $data = $request->validated();
        $newFileName = null;
        if ($type === ResourceType::DOCUMENT) {
            $newFileName = $data['title'].'.pdf';
            $file = $data['file'];
            Storage::putFileAs('', $file, $newFileName);
        }

        if ($type === ResourceType::SNIPPET) {
            $newFileName = $data['title'].'.html';
            Storage::put($newFileName, $request->snippet);
        }

        $resourceType = ResourceType::where('name', $type)->first();
        Resource::create([
            'resource_type_id' => $resourceType->id,
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'url' => $newFileName,
            'value' => $data['value'] ?? null,
            'value_tab' => $data['value_tab'] ?? ''
        ]);
    }

    public function pdfForm() {
        return view('admin.create-pdf');
    }

    public function downloadFile($filename) {
        return Storage::download($filename. '.pdf');
    }

    public function snippetForm() {
        return view('admin.create-snippet');
    }

    public function linkForm() {
        return view('admin.create-link');
    }

    public function delete($id) {
        $deletedResource = Resource::find($id);
        if($deletedResource->url){
            Storage::delete($deletedResource->url);
        }
        DB::table('resources')->where('id', $id)->delete();
        return redirect()->back();
    }

    public function edit(Request $request) {
        $id = $request->id;
        $resource = Resource::find($id);
        if($resource) {
            return view('admin.edit', ['resource' => $resource]);
        }
    }

    public function editResource($id, EditRequest $request) {
        $resource = Resource::find($id);
        if ($resource) {
            $resource->title = $request->title;
            $resource->description = $request->description;
            $resource->save();
        }
    }
}
