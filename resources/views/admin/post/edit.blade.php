<x-admin>
    @section('title')
        {{ 'Edit Collection' }}
    @endsection
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Collection</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.company.index') }}" class="btn btn-info btn-sm">Back</a>
                        </div>
                    </div>
                    <form class="needs-validation" novalidate action="{{ route('admin.company.update', $data) }}"
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
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email"   value="{{ $data->email }}" class="form-control" required>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="logo" class="form-label">Logo</label>
                                        <input type="file" name="logo" id="logo" class="form-control">
                                        @error('logo')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="website" class="form-label">Website</label>
                                        <input type="text" name="website" id="website" value="{{ $data->website }}"class="form-control" required>
                                        @error('website')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-lg-6">
                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                        data-target="#modal-default">
                                        View Image
                                    </button>
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
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">View Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="{{ asset('company-image/' . $data->logo) }}" style="width:200px" alt="" class="w-full modal-img"><br>
                    <span class="text-muted">If you want to change image just add new image otherwise leave it.</span>
                </div>
             
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    {{-- Pdf Modal --}}
    <div class="modal fade" id="ViewPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <iframe src="{{ asset('collection-pdf/' . $data->pdf) }}" frameborder="0" class="w-full"></iframe>
                    <span class="text-muted">If you want to change pdf just add new pdf otherwise leave it.</span>
                </div>
            </div>
        </div>
    </div>
    @section('js')
        <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @endsection
</x-admin>
