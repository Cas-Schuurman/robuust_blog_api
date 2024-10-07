<?php 
use App\Http\Controllers\BlogController;
//I want this form to send the blog id to the controller after i clicked the button instead of response

?>
<div class="modal fade" id="ModalDelete{{ $blog->id }}" tabindex="-1" aria-labelledby="ModalDelete{{ $blog->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ModalDelete{{ $blog->id }}">Delete Blog - {{ $blog->title }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- Send the field as a delete so that the route can find its path --}}
            <form action{{url('deleteblog')}} method="POST">
                {{method_field('delete')}}
                @csrf
                <div class="modal-body">
                    <input type=hidden value="{{$blog->id}}" name="blogid">
                    <p>Are you sure you want to delete this blog? {{$blog->title}}</p>
                </div>
                <div>

                <button type="button" class="btn btn-secondary float-end mt-1 ms-1" data-bs-dismiss="modal">Close</button>
                <input class="btn btn-danger float-end mt-1" type="submit" value="delete">
                </div>
            </form>
        </div>
    </div>
</div>
