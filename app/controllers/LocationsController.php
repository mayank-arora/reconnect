<?php

class LocationsController extends \BaseController {

	public function getLocation($location){
		$location = str_replace(' ', '', $location);
		$url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$location.'&key=AIzaSyDdjxlC_ybPt_fFEaPfzoh8YIRN592yclY';
		$json =json_decode(file_get_contents($url));
		return $json->results['0'];
	}
	public function getCity($loc){
		foreach ($loc->address_components as $key => $value) {
			if($value->types['0'] == 'country'){
				$country = $value->long_name;
			}
			if($value->types['0'] == 'locality'){
				$city = $value->long_name;
			}
			if($value->types['0'] == 'administrative_area_level_1'){
				$state = $value->long_name;
			}
		}
		return $city.','.$state.','.$country;
	}

	public function getLocationId($loc){
		foreach ($loc->address_components as $key => $value) {
			if($value->types['0'] == 'country'){
				$country = $value->long_name;
			}
			if($value->types['0'] == 'locality'){
				$city = $value->long_name;
			}
		}
		$location=array('location'=>$loc->formatted_address, 'city' => $city, 'country'=>$country, 'latitude'=>$loc->geometry->location->lat,
			'longitude'=>$loc->geometry->location->lng, 'place_id'=>$loc->place_id);

		$loc_count = DB::table('locations')->where('place_id', $location['place_id'])->count();
		if($loc_count==0){
			Location::create($location);
			$loc_id = DB::table('locations')->where('place_id', $location['place_id'])->get();
			return $loc_id['0']->id;
		}
		else{
			$loc_id = DB::table('locations')->where('place_id', $location['place_id'])->get();
			return $loc_id['0']->id;
		}
	}


}