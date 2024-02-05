<x-admin>
    @section('title')
        {{ 'Category' }}
    @endsection
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Category Table</h3>
            <div class="card-tools">
                <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-info">New</a>
            </div>
        </div>
        <div class="card-body p-3 m-3">
       
        <table class="table table-bordered data-table">
            <thead>
                <tr>
                <th>Sl No.</th>
                <th  >Category</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        </div>
 
    </div>
</x-admin>


 <style>
    .dataTables_filter{
  float:right!important;
    }
  .dataTables_paginate.paging_simple_numbers{
  float:right!important;

  }

   
       
 </style>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script >
 
$(document).ready(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.category.getCategoryData') }}",
        columns: [ 
            {data: 'id', name: 'id'},
            {data: 'category_name', name: 'category_name'},
  

 
        ]
    });
});
 
</script>

 