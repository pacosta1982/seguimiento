<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use App\Project;
use App\Estates;
use App\Libraries\gpointconverter;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Yajra\Datatables\Facades\Datatables;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    
    const K0 = 0.9996;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
	 * Equatorial Radius
	 * @var integer
	 */
	private $a;

    /**
	 * Square of eccentricity
	 * @var float
	 */
	private $eccSquared;

    public function index()
    {
        $title="Tablero";
        $projects = Project::all();
        $estates = Estates::all();
        //var_dump($estates->utm);
        Mapper::map(-24.3697635, -56.5912129, ['zoom' => 6, 'type' => 'ROADMAP']);
        //Mapper::marker(53.381128999999990000, -1.470085000000040000, ['draggable' => true]);

        /*foreach ($estates as $est) {
            $latlong= $this->ToLL($est[9],$est[10],$est[28]);
            var_dump($latlong);
            //Mapper::marker($latlong['lat'], $latlong['lon']);
        }*/
        /*Mapper::map(-24.3697635, -56.5912129,
        [
            'zoom' => 15,
            'draggable' => true,
            'marker' => false,
            'center' => false,
            'markers' => ['title' => 'To jest właśnie tutaj!', 'animation' => 'DROP'],
            
        ]);*/
        //$collection = collect([]);

        /*$markers = [
            ['lat' => 50.061711, 'lng' => 19.937356],
            ['lat' => 50.063693, 'lng' => 19.911742],
            ['lat' => 50.057979, 'lng' => 19.920445],
            ['lat' => 50.054466, 'lng' => 19.936655]
        ];*/
        //$latlong= $this->convertUtmToLatLng('604841','6982279','21J');
        
        //$play = gpointconverter::convertUtmToLatLng(604841,6982279,'21J');

        //$strings = array("f","l","o","a","t","(",")","E","+");

        /*foreach ($estates as $key => $est) {
            //var_dump($est->utm);
            $latlong= $this->ToLL(strtotime($est->utm_y),strtotime($est->utm_x),strtotime('21J'));
            var_dump($latlong);
            //$lat = str_replace($strings, "", $latlong['lat']);
            //$lon = str_replace($strings, "", $latlong['lon']);
            //Mapper::marker($lat, $lon);
            //$collection->put($key,[['latitude' => $lat, 'longitude' => $lon]]);
            //$latlong= $this->ToLL(strtotime($est->utm_y),strtotime($est->utm_x),strtotime('21J'));
            //$lat = str_replace($strings, "", $latlong['lat']);
            //$lon = str_replace($strings, "", $latlong['lon']);
            //var_dump($latlong['lat']);     
            //var_dump($lon);
            //Mapper::marker($latlong['lat'], $latlong['lon']);
            
            //Mapper::marker($lat, $lon);
        }*/

        //var_dump($collection);

        /*foreach ($collection as $col) {
            //Mapper::marker($col->latitude, $col[1]);
            var_dump($col_>);
        }*/

        return view('dashboard.index',compact('projects','title','map','projects'));
    }

    public function convertUtmToLatLng($UTMEasting, $UTMNorthing, $UTMZone)
	{
		$e1 = (1-sqrt(1-$this->eccSquared))/(1+sqrt(1-$this->eccSquared));
		$x = $UTMEasting - 500000.0; //remove 500,000 meter offset for longitude
		$y = $UTMNorthing;
	
		sscanf($UTMZone,"%d%s",$ZoneNumber,$ZoneLetter);
		
		if (strcmp('N',$ZoneLetter) <= 0) {
			$NorthernHemisphere = 1;//point is in northern hemisphere
		} else {
			$NorthernHemisphere = 0;//point is in southern hemisphere
			$y -= 10000000.0;//remove 10,000,000 meter offset used for southern hemisphere
		}
	
		$LongOrigin = ($ZoneNumber - 1)*6 - 180 + 3;  //+3 puts origin in middle of zone
	
		$eccPrimeSquared = ($this->eccSquared)/(1-$this->eccSquared);
	
		$M = $y / self::K0;
		$mu = $M/($this->a*(1-$this->eccSquared/4-3*$this->eccSquared*$this->eccSquared/64-5*$this->eccSquared*$this->eccSquared*$this->eccSquared/256));
	
		$phi1Rad = $mu	+ (3*$e1/2-27*$e1*$e1*$e1/32)*sin(2*$mu) 
					+ (21*$e1*$e1/16-55*$e1*$e1*$e1*$e1/32)*sin(4*$mu)
					+(151*$e1*$e1*$e1/96)*sin(6*$mu);
		$phi1 = rad2deg($phi1Rad);
	
		$N1 = $this->a/sqrt(1-$this->eccSquared*sin($phi1Rad)*sin($phi1Rad));
		$T1 = tan($phi1Rad)*tan($phi1Rad);
		$C1 = $eccPrimeSquared*cos($phi1Rad)*cos($phi1Rad);
		$R1 = $this->a*(1-$this->eccSquared)/pow(1-$this->eccSquared*sin($phi1Rad)*sin($phi1Rad), 1.5);
		$D = $x/($N1*self::K0);
	
		$Lat = $phi1Rad - ($N1*tan($phi1Rad)/$R1)*($D*$D/2-(5+3*$T1+10*$C1-4*$C1*$C1-9*$eccPrimeSquared)*$D*$D*$D*$D/24
						+(61+90*$T1+298*$C1+45*$T1*$T1-252*$eccPrimeSquared-3*$C1*$C1)*$D*$D*$D*$D*$D*$D/720);
		$Lat = rad2deg($Lat);
	
		$Long = ($D-(1+2*$T1+$C1)*$D*$D*$D/6+(5-2*$C1+28*$T1-3*$C1*$C1+8*$eccPrimeSquared+24*$T1*$T1)
						*$D*$D*$D*$D*$D/120)/cos($phi1Rad);
		$Long = $LongOrigin + rad2deg($Long);
		return array($Lat,$Long);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ToLL($north, $east, $utmZone)
    {
      // This is the lambda knot value in the reference
      $LngOrigin = Deg2Rad($utmZone * 6 - 183);

      // The following set of class constants define characteristics of the
      // ellipsoid, as defined my the WGS84 datum.  These values need to be
      // changed if a different dataum is used.

      $FalseNorth = 10000000;   // South or North?
      //if (lat < 0.) FalseNorth = 10000000.  // South or North?
      //else          FalseNorth = 0.

      $Ecc = 0.081819190842622;       // Eccentricity
      $EccSq = $Ecc * $Ecc;
      $Ecc2Sq = $EccSq / (1. - $EccSq);
      $Ecc2 = sqrt($Ecc2Sq);      // Secondary eccentricity
      $E1 = ( 1 - sqrt(1-$EccSq) ) / ( 1 + sqrt(1-$EccSq) );
      $E12 = $E1 * $E1;
      $E13 = $E12 * $E1;
      $E14 = $E13 * $E1;

      $SemiMajor = 6378137.0;         // Ellipsoidal semi-major axis (Meters)
      $FalseEast = 500000.0;          // UTM East bias (Meters)
      $ScaleFactor = 0.9996;          // Scale at natural origin

      // Calculate the Cassini projection parameters

      $M1 = ($north - $FalseNorth) / $ScaleFactor;
      $Mu1 = $M1 / ( $SemiMajor * (1 - $EccSq/4.0 - 3.0*$EccSq*$EccSq/64.0 - 5.0*$EccSq*$EccSq*$EccSq/256.0) );

      $Phi1 = $Mu1 + (3.0*$E1/2.0 - 27.0*$E13/32.0) * sin(2.0*$Mu1);
        + (21.0*$E12/16.0 - 55.0*$E14/32.0)           * sin(4.0*$Mu1);
        + (151.0*$E13/96.0)                          * sin(6.0*$Mu1);
        + (1097.0*$E14/512.0)                        * sin(8.0*$Mu1);

      $sin2phi1 = sin($Phi1) * sin($Phi1);
      $Rho1 = ($SemiMajor * (1.0-$EccSq) ) / pow(1.0-$EccSq*$sin2phi1,1.5);
      $Nu1 = $SemiMajor / sqrt(1.0-$EccSq*$sin2phi1);

      // Compute parameters as defined in the POSC specification.  T, C and D

      $T1 = tan($Phi1) * tan($Phi1);
      $T12 = $T1 * $T1;
      $C1 = $Ecc2Sq * cos($Phi1) * cos($Phi1);
      $C12 = $C1 * $C1;
      $D  = ($east - $FalseEast) / ($ScaleFactor * $Nu1);
      $D2 = $D * $D;
      $D3 = $D2 * $D;
      $D4 = $D3 * $D;
      $D5 = $D4 * $D;
      $D6 = $D5 * $D;

      // Compute the Latitude and Longitude and convert to degrees
      $lat = $Phi1 - $Nu1*tan($Phi1)/$Rho1 * ( $D2/2.0 - (5.0 + 3.0*$T1 + 10.0*$C1 - 4.0*$C12 - 9.0*$Ecc2Sq)*$D4/24.0 + (61.0 + 90.0*$T1 + 298.0*$C1 + 45.0*$T12 - 252.0*$Ecc2Sq - 3.0*$C12)*$D6/720.0 );

      $lat = Rad2Deg($lat);

      $lon = $LngOrigin + ($D - (1.0 + 2.0*$T1 + $C1)*$D3/6.0 + (5.0 - 2.0*$C1 + 28.0*$T1 - 3.0*$C12 + 8.0*$Ecc2Sq + 24.0*$T12)*$D5/120.0) / cos($Phi1);

      $lon = Rad2Deg($lon);

      // Create a object to store the calculated Latitude and Longitude values
      $PC_LatLon['lat'] = $lat;
      $PC_LatLon['lon'] = $lon;

      // Returns a PC_LatLon object
      return $PC_LatLon;
      //return "['latitude' => ".$lat.", 'longitude' => ".$lon."], ";
    }
    
}
