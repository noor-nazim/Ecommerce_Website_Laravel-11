<!DOCTYPE html>
<html>
<head> 
    @include('admin.css')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <style type="text/css">
        input[type='text'] {
            width: 400px;
            height: 50px;
        }

        .div_design {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        .table_design {
            border: 2px solid greenyellow;
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
            text-align: center;
        } 
        
        input[type = 'search']{

            width: 500px;
            height: 60px;
            margin-left:50ox;
        }
    </style>
</head>
<body>
    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

            <form action= "{{url('product_search')}}" method="get">
                @csrf
                <input type="search" name="search">
                <input type="submit" class= "btn btn-secondary" value = "Search">
            </form>
                <div class="div_design">
                    <table class="table_design">
                        <tr>
                            <th>Product Title</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        @foreach($product as $products)
                        <tr>
                            <td>{{$products->title}}</td>
                            <td>{!!Str::limit($products->description, 30)!!}</td>
                            <td>{{$products->category}}</td>
                            <td>{{$products->price}}</td>
                            <td>{{$products->quantity}}</td>
                            <td>
                                <img height="120" width="120" src="products/{{$products->image}}">
                            </td>

                            <td>
                                <a class="btn btn-success" href="{{url('update_product',$products->id)}}">Edit</a>

                            </td>

                            <td>
                            <button class="btn btn-danger" onclick="confirmDelete('{{ url('delete_product',$products->id) }}')">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>

                <div class="div_design">
                    {{$product->onEachSide(1)->links()}}
                </div>
            </div>  
        </div>
    </div>

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