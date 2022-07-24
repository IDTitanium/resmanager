<?php

namespace Database\Seeders;

use App\Models\Resource;
use App\Models\ResourceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resourceTypes = [];
        foreach ($this->types() as $type) {
            $resourceTypes[] = ResourceType::firstOrCreate($type);
        }

        $this->createResources($resourceTypes);
    }

    private function types() {
        return collect([
            [
                'name' => 'document',
                'description' => 'Documents like pdf, docs etc'
            ],
            [
                'name' => 'link',
                'description' => 'Links to other websites'
            ],
            [
                'name' => 'snippet',
                'description' => 'Code snippets like html, css, php etc'
            ]
        ]);
    }

    private function createResources ($resourceTypes) {
        foreach ($resourceTypes as $resourceType) {
            if ($resourceType->name === 'document') {
                Resource::create([
                    'title' => 'A new pdf',
                    'description' => 'A generic pdf',
                    'resource_type_id' => $resourceType->id,
                    'url' => 'A new pdf.pdf'
                ]);
            }

            if ($resourceType->name === 'link') {
                Resource::create([
                    'title' => 'A blog link',
                    'description' => 'Idris lawal blog link',
                    'resource_type_id' => $resourceType->id,
                    'value' => 'https://idris-lawal.hashnode.dev'
                ]);
            }

            if ($resourceType->name === 'snippet') {
                Resource::create([
                    'title' => 'A new snippet',
                    'description' => 'A generic snippet',
                    'resource_type_id' => $resourceType->id,
                    'url' => 'test.html'
                ]);
            }

        }
    }
}
