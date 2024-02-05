<x-admin>
    @section('title')
        {{ 'Edit Post' }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Post</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.post.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form  id="formdata-p" class="needs-validation" novalidate action="{{ route('admin.post.update', $data) }}"
                        method="POST" enctype="multipart/form-data">

                        @method('PUT')
                        @csrf
                        <input type="hidden" name="edit_id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" value="{{ $data->name }}"
                                            class="form-control" required>
                                        @error('name')
                                            <span>{{ $message }}</span>
                                        @enderror
                                        <span class="errorClass"id="name_err"></span>

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" value="{{ $data->date }}" class="form-control" required>

                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <span class="errorClass"id="date_err"></span>

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="image" class="form-label">image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        @error('image')
                                            <span>{{ $message }}</span>
                                        @enderror

                                        <span class="errorClass"id="image_err"></span>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" name="author" id="author" value="{{ $data->author }}"class="form-control" required>
                                        @error('author')
                                            <span>{{ $message }}</span>
                                        @enderror

                                        <span class="errorClass"id="author_err"></span>


                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <img src="{{ asset('post-image/' . $data->image) }}" style="width:100px" alt="" class="w-full modal-img"><br>
                                </div>

                            </div>
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea name="content" class="textarea" style="width: 100%; height: 200px">{{ $data->content}}</textarea>
                                        @error('content')
                                            <span>{{ $message }}</span>
                                        @enderror
                                        <span class="errorClass" id="content_err"></span>
                                    </div>
                                </div>

                        </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Image Modal --}}
    {{-- <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('post-image/' . $data->image) }}" style="width:200px" alt="" class="w-full modal-img"><br>
                    <span class="text-muted">If you want to change image just add new image otherwise leave it.</span>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> --}}


    @section('js')


    @endsection
</x-admin>


<script type="text/javascript">
    $(document).ready(function() {
      $('.textarea').wysihtml5();
    });


    $(document).ready(function() {
        var pram = '{{$data}}';

        $('body').on('click','#submit-p',function(e){

            $(".errorClass").text("");
            $.ajax({
                data: new FormData(this),

                url: "/post/update/" + pram,
                method: 'POST',
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function(data) {
                    if( data['status_code'] == 200) {
                        window.location.href = '/admin/post';


                    }
                },
                error: function (data) {
                       var r = jQuery.parseJSON(data.responseText);
                    jQuery.each(r.errors, function(index, item) {
                        $('#'+index+'_err').text(item);

                        })

                }
            });
            return false;
        });
    });



    </script>
