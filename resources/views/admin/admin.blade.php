@include('admin.header')

<body>
    <div id="app">
        <admin-page>
        </admin-page>
    </div>

    <div class="container mt-3">
        <h2 class="text-center">Resources List</h2>
        <table class="table table-hover table-responsive table-bodered">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Type</th>
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
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.resources.edit', ['id' => $resource->id]) }}" class="btn btn-primary">
                                Edit
                            </a>
                        </div>
                        <div class="btn-group" role="group">
                            <form action="{{ route('admin.resources.delete', ['id' => $resource->id]) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <button class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
