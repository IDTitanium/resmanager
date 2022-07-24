<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
    <div class="container mt-3">
        <h2 class="text-center">Resources List</h2>
        <a class="mb-5 btn btn-sm btn-success" href="/admin">Go to Admin page</a>
        <table class="table table-hover table-responsive table-bodered">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Type</th>
                <th>View</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($resources as $resource)
                <tr>
                    <td>{{ $resource->title }}</td>
                    <td>{{ $resource->description }}</td>
                    <td>{{ $resource->resourceType->name }}</td>

                    <td>
                        <div class="bg-dark h-50 p-2 text-dark bg-opacity-10">
                            @if($resource->content)
                                {{-- <x-markdown> --}}
                                    {{ json_decode($resource->content) }}
                                {{-- </x-markdown> --}}

                                <button id="#copyBtn{{$resource->id}}" data-bs-toggle="tooltip" title="Copied!" class="btn btn-sm btn-outline btn-primary" onclick="copyToClipboard( {{ $resource->content }} )">Copy</button>
                            @elseif($resource->value)
                                <a href="//{{$resource->value}}" target="{{$resource->value_tab ?? ''}}">{{$resource->value}}</a>
                            @else
                                --
                            @endif

                        </div>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            @if($resource->url && $resource->resourceType->name === \App\Models\ResourceType::DOCUMENT)
                                <a class="btn btn-success" href="{{ '/admin/resource/pdf/download/'. $resource->title }}" target="blank">
                                    Download
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</html>
<script>
    function copyToClipboard (str) {
        let el = document.createElement('textarea');
        el.value = str;
        el.setAttribute('readonly', '');
        el.style = {position: 'absolute', left: '-9999px'};
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    }

    (function enableTooltip() {
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                boundary: document.body,
                trigger: 'click'
            })
        })
    })()
</script>
