
@extends('master.admin')

@section('page-title')
Operator
@endsection

@section('main-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="vue-user">

    <!-- Main content -->
    <div class="content">   
        <div class="container-fluid pt-5">
            <nav class="navbar navbar-light bg-gradient-blue" >
                <span class="navbar-brand mb-0 h1">Fleet Management</span>
                <button data-toggle="modal" data-target="#driverModal" data-whatever="@mdo" class="btn btn-outline-danger my-2 my-sm-0">Add Driver</button>
            </nav>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Licence Number</th>
                        <th scope="col">Name</th>
                        <th scope="col">Surname</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($drivers as $data)
                    <tr>
                        <th scope="row">{{$data->licence_number}}</th>
                        <td>{{$data->name}}</td>
                        <td>{{$data->surname}}</td>
                        
                      
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<div class="modal fade" id="driverModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('/adddriver')}}" method="post">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-user-alt"></i> Add Driver</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" name="licencenumber" id="licencenumber" placeholder="licencenumber ">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control"  name="name" id="name" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <input type="text"  class="form-control" name="surname" id="surname" placeholder="surname">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- /.content-wrapper -->
@endsection
