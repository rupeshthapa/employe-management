<!-- Bootstrap Bundle JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/YOUR_KIT_ID.js" crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>

    toastr.options = {
        "positionClass": "toast-top-right",
        "closeButton": true,
        "progressBar": true,
        "timeOut": "5000",
        "extendedTimeOut": "1000"
    }

    @if (session('success'))
        toastr.success("{{ session('success') }}")
    @endif

    @if(session('error'))
    toastr.error("{{ session('error') }}")
    @endif
</script>

<script>
    const profile = document.getElementById('profile');
    const menu = document.getElementById('profileMenu');

    profile.addEventListener('click', ()=>{
        if(menu.style.display == 'none' || menu.style.display == '' ){
            menu.style.display = 'block';
        }else{
            menu.style.display = 'none';
        }
    });
</script>

<script>
      
$(document).on('click', '.delete-department', function (e) {
    e.preventDefault();
    let id = $(this).data('id');
    console.log('delete button clicked');
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `{{ route('nav.department.destroy', ':id') }}`.replace(':id', id),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    Swal.fire('Deleted!', response.message, 'success');
                    $('#departmentTable').DataTable().ajax.reload(); // reload DataTable
                },
                error: function (xhr) {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                    console.log(xhr.responseText);
                }
            });
        }
    });
});
</script>



@stack('scripts')