<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')

    <style type="text/css">
        input[type='text'] {
            width: 400px;
            height: 50px;
        }

        .div_design {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px;
        }

        .table_design {
            text-align: center;
            margin: auto;
            border: 2px solid yellowgreen;
            margin-top: 50px;
            width: 600px;
        }

        th {
            background-color: skyblue;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        td {
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
        }      
    </style>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body>
    @include('admin.header')
    
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1 style="color: white;">Add Category</h1>

                <div class="div_design">
                    <form action="{{url('add_category')}}" method="post">
                        @csrf
                        <div>
                            <input type="text" name="category">
                            <input class="btn btn-primary" type="submit" value="Add Category">
                        </div>
                    </form>
                </div>

                <div>
                    <table class="table_design">
                        <tr>
                            <th>Category Name</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        @foreach($data as $category)
                        <tr>
                            <td>{{$category->category_name}}</td>

                            <td>
                            <a class="btn btn-success" href="{{url('edit_category', $category->id)}}">Edit</a>
                            </td>
                            <td>
                            <button class="btn btn-danger" onclick="confirmDelete('{{ url('delete_category',$category->id) }}')">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>  
        </div>
    </div>

    <!-- Toastr notifications -->
    @if(session('success'))
    <script>
        toastr.success('{{ session('success') }}');
    </script>
@endif

    <!-- JavaScript files-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"></script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>

    <!-- Toastr JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- JavaScript code for delete confirmation -->
    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: "Are you sure to delete this?",
                text: "This delete will be parmanent",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>

    <!-- Toastr initialization -->
    <script>
        // Initialize Toastr
        toastr.options = {
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    
</body>
</html>