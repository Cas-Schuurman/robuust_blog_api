<div class="modal fade" id="ModalEdit{{ $blog->id }}" tabindex="-1" aria-labelledby="ModalEditLabel{{ $blog->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ModalEditLabel{{ $blog->id }}">Edit Blog - {{ $blog->title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action{{url('editblog')}} method="POST">
                @csrf
                <div class="modal-body">
                    <input type=hidden value="{{$blog->id}}" name="blogid">
                    <div>
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}">
                    </div>
                    <div>
                        <label for="body">Body</label>
                        <input type="text" class="form-control" id="body" name="body" value="{{ $blog->body }}">
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary float-end mt-1 ms-1" data-bs-dismiss="modal">Close</button>
                        <input class="btn btn-success float-end mt-1" type="submit" value="submit">
                    </div>
                </div>
            
            </form>
        </div>
    </div>
</div>
