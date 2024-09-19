<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
</head>
<body>

@section('content')
<h1>Blogs</h1>

<table class="table table-bordered table-hover">
    <thead>
        <th>Title</th>
        <th>Body</th>
        <th>Author</th>
        <th>Created_At</th>
        <th>Actions</th>
    </thead>
    <tbody>
        @if ($blogs->count() == 0)
            <tr>
                <td colspan="4">No blogs in the database.</td>
            </tr>
        @endif


        @foreach ($blogs as $blog)
        {{dd($blog)}}
        <tr>
            <td>{{ $blog->title }}</td>
            <td>{{ $blog->body}}</td>
            <td>{{ $blog->author_ID }}</td>
            <td>{{ $blog->created_at }}</td>
        </tr>
        @endforeach

    </tbody>
</table>


    {{-- {{ $blogs->links() }} --}}
{{-- @endsection --}}
  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>