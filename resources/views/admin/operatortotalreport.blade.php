
@extends('master.admin')

@section('page-title')
Operator
@endsection

@section('main-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="vue-user">

    <!-- Main content -->
    <div class="content">   
        <div class="row">
              <div class="col-6 pt-5">
            <nav class="navbar navbar-light bg-gradient-blue" >
                <span class="navbar-brand mb-0 h1">Mileage - CashIn  By Date     Report</span>
                <!--÷<button data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" class="btn btn-outline-danger my-2 my-sm-0">Add Vehicle</button>-->
            </nav>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Total Mileage</th>
                        <th scope="col">Total Cash-in</th>
                        <th scope="col">Reg Number</th>
                        <th scope="col">Date</th>
                       
                    </tr>
                </thead>
                <tbody>
                     @foreach($totalmcd as $data)
                    <tr>
                        <td><a>{{$data->Mileage}}Km</a></td>
                        <td>${{$data->Cashin}}</td>
                        <td>{{$data->fl_regnumber   }}</td>
                         <td>{{$data->created_at   }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div><!-- /.container-fluid -->
        
        
          <div class="col-6 pt-5">
            <nav class="navbar navbar-light bg-gradient-blue" >
                <span class="navbar-brand mb-0 h1">Mileage - CashIn  Report</span>
                <!--÷<button data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" class="btn btn-outline-danger my-2 my-sm-0">Add Vehicle</button>-->
            </nav>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Total Mileage</th>
                        <th scope="col">Total Cash-in</th>
                        <th scope="col">Reg Number</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($totalmc as $data)
                    <tr>
                        <td><a>{{$data->Mileage}}Km</a></td>
                        <td>${{$data->Cashin}}</td>
                        <td>{{$data->fl_regnumber   }}</td>
                      
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div><!-- /.container-fluid -->
        </div>
        
        
        
          <div class="row">
              <div class="col-12 pt-5">
            <nav class="navbar navbar-light bg-gradient-blue" >
                <span class="navbar-brand mb-0 h1">Mileage - CashIn  By Driver     Report</span>
                <!--÷<button data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" class="btn btn-outline-danger my-2 my-sm-0">Add Vehicle</button>-->
            </nav>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Total Mileage</th>
                        <th scope="col">Total Cash-in</th>
                        <th scope="col">Reg Number</th>
                        <th scope="col">Driver</th>
                       
                    </tr>
                </thead>
                <tbody>
                     @foreach($totalmcdriver as $data)
                    <tr>
                        <td><a>{{$data->Mileage}}Km</a></td>
                        <td>${{$data->Cashin}}</td>
                        <td>{{$data->fl_regnumber   }}</td>
                         <td>{{$data->drivername   }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div><!-- /.container-fluid -->
        
        
       
        </div>
    </div>
    <!-- /.content -->
</div>


<!-- /.content-wrapper -->
@endsection
