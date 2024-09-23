<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>

@section('content')
<div class="container">
<h1>Blogs</h1>
{{-- Create table --}}
    <table id="blogtable" class="table table-bordered table-hover table-striped">
        <thead>
            <th>Title</th>
            <th>Body</th>
            <th>Author</th>
            <th>Created_At</th>
            <th>Updated_At</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @if ($blogs->count() == 0)
                <tr>
                    <td colspan="5">No blogs in the database.</td>
                </tr>
            @endif

            {{-- Loop trough all the blogs and show every blog --}}
            @foreach ($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>
                <td class="text-truncate blogbody">{{ $blog->body }}</td>
                <td>{{ $blog->author->firstname }} {{$blog->author->lastname}}</td>
                <td>{{ $blog->created_at }}</td>
                <td>{{ $blog->updated_at }}</td>
                <td>
                    <div>
                        {{-- Create modal links so that its a nice popup --}}
                        <a href="#" data-bs-toggle="modal" data-bs-target="#ModalInsight{{$blog->id}}"><img class="icon" src="{{ URL::to('/') }}/icons/eye.svg"></a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#ModalEdit{{$blog->id}}"><img class="icon" src="{{ URL::to('/') }}/icons/pencil.svg"></a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#ModalDelete{{$blog->id}}"><img class="icon delete_icon" src="{{ URL::to('/') }}/icons/bin.svg"></a>
                    </div>
                </td>
            </tr>
            {{-- Include the popup files --}}
            @include("modal.edit", ["blog" => $blog])
            @include("modal.insight", ["blog" => $blog])
            @include("modal.delete", ["blog" => $blog])
            @endforeach
        </tbody>
    </table>

    {{ $blogs->links('pagination::bootstrap-5') }}

</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
    new DataTable('#blogtable')
</script>
</body>
