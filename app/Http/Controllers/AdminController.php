<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\SellTicket;

class AdminController extends Controller {

    //  check authentication that user logged in or not
    public function __construct() {
        $this->middleware('auth');
    }

    // populate dashboard
    public function dashboard() {
        return view(
                'admin.dashboard',
                [
                    'todaysTotalOrder' => SellTicket::where('created_at', '>=', Carbon::today())->get(),
                    'totalPendingOrder' => DB::table('sell_tickets')->where('seat_available', 0)
                ]
        );
    }

    public function user() {
        return view('admin.user');
    }

    public function profile() {
        return view('admin.profile');
    }

    public function counter() {
        return view('admin.counter');
    }

    public function ticket() {
        return view('admin.ticket');
    }

    public function city() {
        return view('admin.city');
    }

    public function trip_point() {
        return view('admin.trip_point');
    }

    public function trip_route() {
        return view('admin.trip_route');
    }

    public function origincity() {
        return view('admin.origincity');
    }

    public function destinationcity() {
        return view('admin.destinationcity');
    }

    public function route() {
        return view('admin.route');
    }

    public function details() {
        return view('admin.details');
    }

    public function operator() {

        $fleet = DB::table('fleet')
                ->get();


        $drivers = DB::table("drivers")
                ->get();

        $data = array(
            "fleet" => $fleet,
            "drivers" => $drivers
        );

        return view('admin.operator', $data);
    }

    public function boarding() {
        return view('admin.boarding');
    }

    public function addfleet(Request $request) {

//        return $request ;

        DB::table('fleet')
                ->insert([
                    "fl_regnumber" => $request->regnumber,
                    "fl_model" => $request->model,
                    "fl_seater" => $request->seater,
                    "fl_litres" => $request->litres,
                    "fl_fuel" => $request->fuel,
                    "fl_driver" => $request->drivers
        ]);



//        return $data;
        return self::operator();
    }

    public function vehicleprofile($id) {

        $trips = DB::table('trips')
                ->where('fl_regnumber', $id)
                ->orderBy("created_at", 'DESC')
                ->get();

        $total = 0;
        foreach ($trips as $data) {
            $total = $total + $data->cashin;
        }


        $drivers = DB::table('drivers')
                ->get();

        $fleet = DB::table('fleet')
                ->where('fl_regnumber', $id)
                ->first();


        $data = array(
            'trips' => $trips,
            "fleet" => $fleet,
            "drivers" => $drivers,
            "vehicle" => $id,
            "total" => $total
        );

//        return $data ;

        return view('admin.vehicleprofile', $data);
    }

    public function addTripp(Request $request) {

//        return $request;
        date_default_timezone_set('Africa/Harare');


        $trip = DB::table("trips")
                ->where('created_at', $request->date)
                ->where('fl_regnumber', $request->fl_regnumber)
                ->get();

        if (sizeof($trip) == 0) {

            DB::table('trips')
                    ->insert([
                        "mileage" => $request->mileage,
                        "cashin" => $request->cashin,
                        "report" => $request->report,
                        "created_at" => $request->date,
                        "updated_at" => date("Y-m-d G.i:s", time()),
                        "fl_regnumber" => $request->fl_regnumber,
                        "drivername" => $request->driver,
            ]);
        }




        return self::vehicleprofile($request->fl_regnumber);
    }

    public function getTripp($fleetid) {
        date_default_timezone_set('Africa/Harare');
        $trips = DB::table('trips')
                ->get();
    }

    public function drivers() {

        $drivers = DB::table("drivers")
                ->get();

        $data = array(
            "drivers" => $drivers);

        return view('admin.drivers', $data);
    }

    public function adddriver(Request $request) {
        date_default_timezone_set('Africa/Harare');
        DB::table('drivers')
                ->insert([
                    "licence_number" => $request->licencenumber,
                    "name" => $request->name,
                    "surname" => $request->surname,
        ]);

        return self::drivers();
    }

    public function assignto($number, $vehicle) {

        $driver = DB::table("drivers")
                ->where('licence_number', $number)
                ->first();

        $affected = DB::table('fleet')
                ->where('fl_regnumber', $vehicle)
                ->update(
                [
                    'fl_driver' => $driver->name . " " . $driver->surname
                ]
        );


          $trips = DB::table('trips')
                ->where('fl_regnumber', $vehicle)
                ->orderBy("created_at", 'DESC')
                ->get();

        $total = 0;
        foreach ($trips as $data) {
            $total = $total + $data->cashin;
        }


        $id = $vehicle;
        $trips = DB::table('trips')
                ->where('fl_regnumber', $id)
                ->get();


        $drivers = DB::table('drivers')
                ->get();

        $fleet = DB::table('fleet')
                ->where('fl_regnumber', $id)
                ->first();


        $data = array(
            'trips' => $trips,
            "fleet" => $fleet,
            "drivers" => $drivers,
            "vehicle" => $id ,
            "total"=>$total
        );



        return view('admin.vehicleprofile', $data);
    }
    
    
    public function deletefleet ($numbeer){
        
        DB::table('fleet')->where('fl_id', $numbeer)->delete();
        
        return self::operator() ;
    } 
    
    
    
    public function operatorreport() {
        
         $fleet = DB::table('fleet')
                ->get();


        $drivers = DB::table("drivers")
                ->get();

        $data = array(
            "fleet" => $fleet,
            "drivers" => $drivers
        );

        return view('admin.operatorreport', $data);
        
    }
    
    public function operatortotalreport() {
         $fleet = DB::table('fleet')
                ->get();


        $drivers = DB::table("drivers")
                ->get();
        
        $totalmc =DB::select("SELECT SUM(mileage) as 'Mileage' ,SUM(cashin) as 'Cashin' ,fl_regnumber FROM `trips` GROUP by mileage, cashin,fl_regnumber ORDER BY `Mileage` DESC");

        
         $totalmcd =DB::select("SELECT SUM(mileage) as 'Mileage' ,SUM(cashin) as 'Cashin' ,fl_regnumber  ,created_at FROM `trips` GROUP by mileage, cashin,fl_regnumber ,created_at  ORDER BY `Mileage` DESC");

         
          $totalmcdriver =DB::select("SELECT SUM(mileage) as 'Mileage' ,SUM(cashin) as 'Cashin' ,fl_regnumber  ,drivername FROM `trips` GROUP by mileage, cashin,fl_regnumber ,drivername  ORDER BY `Mileage` DESC");

        $data = array(
            "fleet" => $fleet,
            "drivers" => $drivers ,
            "totalmc" =>$totalmc ,
            'totalmcd'=>$totalmcd ,
            'totalmcdriver'=>$totalmcdriver
        );

        
        return view('admin.operatortotalreport', $data);
        
    }

}
