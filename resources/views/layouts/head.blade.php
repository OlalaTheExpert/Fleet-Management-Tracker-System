<!-- App favicon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/') }}">
<meta name="viewport" content="width=device-width, initial-scale=1">      
@yield('css')

 <!-- App css -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ URL::asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />

{{-- <link href="{{ URL::asset('plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"> --}}
<link href="{{ asset('plugins/sweetalert.min.css') }}" rel="stylesheet">
<!-- Table css -->
<link href="{{ URL::asset('plugins/RWD-Table-Patterns/dist/css/rwd-table.min.css') }}" rel="stylesheet" type="text/css" media="screen">
<!-- DataTables -->
<link href="{{ URL::asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ URL::asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />



<script>
    $(document).ready(function() {
        $('select').selectize({
            sortField: 'text'
        });
    });
</script>

{{-- sweetalert --}}
<script>

    window.addEventListener('show-delete-confirmation', event=>{
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            Swal.fire(
                Livewire.emit('deleteConfirmed')
            )
            }
  })
    });

  </script>