
@extends('master.admin')

@section('page-title')
User - Profile
@endsection

@section('main-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="vue-user">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid pt-5">
            <nav class="navbar navbar-light bg-gradient-blue" >
                <span class="navbar-brand mb-0 h1">Fleet Management</span>
                <button data-toggle="modal" data-target="#RecordTrip" data-whatever="@mdo" class="btn btn-outline-danger my-2 my-sm-0">Record Trip</button>
            </nav>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="text-center">
                            <img class="card-img-top" src="{{asset('img/avatar.png')}}"  style="height: 125px; width: 120px;" alt="Card image cap">
                        </div>
                        <div class="card-body box-profile">
                            <h5 class="card-title">Driver Details</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$fleet->fl_driver}}</li>
                        </ul>
                        <div class="card-body">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Assign Vehicle To :
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach($drivers as $data)
                                    <a class="dropdown-item" href="{{url('/assignto/'.$data->licence_number."/vehicle/".$vehicle)}}">{{$data->name}}  {{$data->surname}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Vehicle</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Driver</th>
                                    <th scope="col">Milage</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                total
                                @foreach($trips as $data)
                                <tr>
                                    <td scope="row">{{$data->fl_regnumber}}</th>
                                    <td>{{$data->created_at}}</td>
                                    <td>{{$data->drivername}}</td>
                                    <td>{{$data->mileage}} Km</td>
                                    <td>${{$data->cashin}}</td>
                                </tr>
                                @endforeach
                                <tr style="color: #600">
                                    <td scope="row">Total Cash-In</th>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="color: #600">${{$total}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.container-fluid -->


        </div>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="RecordTrip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form action="{{url('/addTrip')}}" method="post">
            @csrf
            <input type="hidden" name="driver" value="{{$fleet->fl_driver}}">
            <input type="hidden" name="fl_regnumber" value="{{$fleet->fl_regnumber}}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Record Trip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <input type="date" class="form-control" id="date" name="date" required="true">
                        </div>

                        <div class="form-group">
                            <input type="number" step="0.01" class="form-control" id="mileage" name="mileage" placeholder="Daily Mileage"  required="true">
                        </div>

                        <div class="form-group">
                            <input type="number" step="0.01" class="form-control" id="cashin" name="cashin" placeholder="Daily cashin"  required="true">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" id="report" name="report" placeholder="Daily Reports eg Police Fine ,Mechenical faults"  required="true"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send message</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- /.content-wrapper -->
    @endsection
