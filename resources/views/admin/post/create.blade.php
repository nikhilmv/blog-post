<x-admin>
    @section('title')
        {{ 'Create Post' }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create Post</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.post.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form  id="formdata-p" class="needs-validation" novalidate action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
                                        @error('name')
                                            <span>{{ $message }}</span>
                                        @enderror

                                        <span class="errorClass"id="name_err"></span>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" value="{{ old('date') }}" class="form-control" required>

                                            @error('date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <span class="errorClass"id="date_err"></span>

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="date">Author</label>
                                        <input type="text" name="author" id="author" value="{{ old('author') }}" class="form-control" required>

                                            @error('author')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                            <span class="errorClass"id="author_err"></span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="image" id="image" class="form-control" required>
                                        @error('image')
                                            <span>{{ $message }}</span>
                                        @enderror
                                        <span class="errorClass"id="image_err"></span>
                                    </div>
                                </div>
                                <br>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea name="content" class="textarea" style="width: 100%; height: 200px"></textarea>
                                        @error('content')
                                            <span>{{ $message }}</span>
                                        @enderror
                                        <span class="errorClass" id="content_err"></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" id="submit-p" class="btn btn-primary float-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin>
@section('css')
<style>
    .errorClass {
        color:red!important;
    }
</style>
@endsection

<script type="text/javascript">
    $(document).ready(function() {
      $('.textarea').wysihtml5();
    });




    $(document).ready(function() {
        $('body').on('click','#submit-p',function(e){

            $(".errorClass").text("");
            $.ajax({
                data: $('#formdata-p').serialize(),
                url: "{{ route('admin.post.store') }}",
                type:'POST',
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

