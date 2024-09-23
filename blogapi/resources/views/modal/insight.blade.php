{{-- Just a simple insight modal with readonly fields --}}
<div class="modal fade" id="ModalInsight{{ $blog->id }}" tabindex="-1" aria-labelledby="ModalInsight{{ $blog->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ModalInsight{{ $blog->id }}">Blog - {{ $blog->title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $blog->title }}" readonly>
                </div>
                <div>
                    <label for="body">Body</label>
                    <input type="text" class="form-control" id="body" name="body" value="{{ $blog->body }}" readonly>
                </div>
                <div>
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author" value="{{ $blog->author->firstname }} {{$blog->author->lastname }}" readonly>
                </div>
                <div>
                    <label for="created_at">Created At</label>
                    <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $blog->created_at }}" readonly>
                </div>
                <div>
                    <label for="updated_at">Updated At</label>
                    <input type="text" class="form-control" id="updated_at" name="updated_at" value="{{ $blog->updated_at }}" readonly>
                </div>
            <button type="button" class="btn btn-secondary float-end mt-1 ms-1" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
