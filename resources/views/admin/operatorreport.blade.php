
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
                <span class="navbar-brand mb-0 h1">Fleet Report</span>
                <!--÷<button data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" class="btn btn-outline-danger my-2 my-sm-0">Add Vehicle</button>-->
            </nav>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Reg Number</th>
                        <th scope="col">Model</th>
                        <th scope="col">Seater</th>
                        <th scope="col">Litres</th>
                        <th scope="col">Fuel</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($fleet as $data)
                    <tr>
                        <th scope="row">{{$data->fl_id}}</th>
                        <td><a href="{{url('vehicleprofile/'.$data->fl_regnumber)}}">{{$data->fl_regnumber}}</a></td>
                        <td>{{$data->fl_model}}</td>
                        <td>{{$data->fl_seater}}</td>
                        <td>{{$data->fl_litres}}</td>
                        <td>{{$data->fl_fuel}}</td>
                      
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{url('/addfleet')}}" method="post">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> <i class="fa fa-bus"></i> Add Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" name="regnumber" id="regnumber" placeholder="Registration Number">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control"  name="model" id="model" placeholder="Model">
                    </div>

                    <div class="form-group">
                        <input type="number" min="0" class="form-control" name="seater" id="seater" placeholder="Seater">
                    </div>

                    <div class="form-group">
                        <select class="custom-select" id="inputGroupSelect04" name="fuel" id="fuel">
                            <option selected>Choose fuel type...</option>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input  type="number" min="0" class="form-control" name="litres" id="litres" placeholder="Fuel in litres">
                    </div>

                    <div class="form-group">
                        <select class="custom-select" id="inputGroupSelect04" name="drivers" id="drivers">
                            <option selected>Choose driver...</option>
                            @foreach($drivers as $data)
                            <option value="{{$data->surname}} {{$data->name}}">{{$data->name}} {{$data->surname}}</option>
                            @endforeach
                        </select>
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
