@extends('layouts.app')
@section('title', 'Designations')
@section('content')

    <div class="container my-5">
        <button class="btn btn-primary d-flex align-items-center mb-3" data-bs-toggle="modal"
        data-bs-target="#desginationModal">
            <i class="fa-solid fa-circle-plus me-2"></i>New Designation
        </button>
    </div>

@endsection
@push('modals')
    @include('modals.designation.create')
@endpush


@push('scripts')
<script>

    $(document).ready(function(){
        $('#desginationModal').on('submit', function(e){
            e.preventDefault();

            $('#designationNameError').text('').hide();
            $('#designation_name').removeClass('is-invalid');

            let name = $('#designation_name').val();

            $.ajax({
                url: "{{ route('nav.designations.store') }}",
                method: 'POST',
                data:{
                    _token: "{{ csrf_token() }}",
                    name: name
                },
                success: function(response){
                    toastr.success(response.message);
                    $('#createDesignationForm')[0].reset();
                },
                error: function(error){

                }
            });
        });
    });
    </script>
@endpush