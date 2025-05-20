@extends('layouts.app')
@section('title', 'Department')
@section('content')

    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal" data-bs-target="#departmentModal"><i class="fa-solid fa-circle-plus me-2"></i>New Department</button>
        
        
        <table id="departmentTable" class="table table-bordered table-striped my-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department Name</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>

        <!-- Modal -->
@include('department.create');
@include('department.edit');

<script>
    $(document).ready(function(){
        $('#departmentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('nav.department.index.data') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'created_at', name: 'created_at'},
                // {data: 'action', name: 'action', render: function(meta,data){
                //     return "helkl9o";
                // }, searchable: false, orderable: false}
                {data: 'actions', name: 'actions', searchable: false, orderable: false}

            ]
        })
    })
</script>

@endsection