@extends('layouts.boilerplate')

@section('title')
<title>Search </title>
<style type="text/css">
#map-canvas {height: 500px; margin: 0; padding: 0;}
</style>
<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDdjxlC_ybPt_fFEaPfzoh8YIRN592yclY">
</script>
<script type="text/javascript">
function initialize() {
  var mapOptions = {
    mapTypeId: 'roadmap',
    zoom: 8
  }
  var locations = [
  <?php
  foreach($locations as $location){
    echo "['".$location->location."',".$location->latitude.",".$location->longitude.",".$location->users->count().",".$location->id."],";
  }

  ?>
  ];
  var bounds = new google.maps.LatLngBounds();
  var map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
  var infowindow = new google.maps.InfoWindow();


  // var image = {
  //   url: 'img/applied-check.png',
  //   // This marker is 20 pixels wide by 32 pixels tall.
  //   size: new google.maps.Size(30, 30),
  //   // The origin for this image is 0,0.
  //   origin: new google.maps.Point(0,0),
  //   // The anchor for this image is the base of the flagpole at 0,32.
  //   anchor: new google.maps.Point(0, 0)
  // };


  for(i=0 ; i < locations.length ; i++){
    var position = new google.maps.LatLng(locations[i][1], locations[i][2]);
    if(locations[i][3] == 1){
      var user_count = locations[i][3]+" user";
    }
    else{
      var user_count = locations[i][3]+" users";      
    }
    bounds.extend(position);
    var marker = new google.maps.Marker({
      position: position,
      animation: google.maps.Animation.DROP,
      map: map,
      info: user_count,
      title: locations[i][0]
      // icon: image
    });
    google.maps.event.addListener(marker, 'click', function () {
      infowindow.setContent(this.info);
      infowindow.open(map, this);
    });
  }
  map.fitBounds(bounds);
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
@overwrite


@section('navbar')
@include('partials._navbar')
@overwrite



@section('body')
<div class="container">
  <ul class="nav nav-tabs">
    <li id="search-batch-tab" role="presentation" class="active"><a class="batch-tab">Batch</a></li>
    <li id="search-branch-tab" role="presentation"><a class="branch-tab">Branch</a></li>
    <li id="search-profession-tab" role="presentation"><a class="profession-tab">Profession</a></li>
    <li id="search-domain-tab" role="presentation"><a class="domain-tab">Domain</a></li>
    <li id="search-location-tab" role="presentation"><a class="location-tab">Location</a></li>
  </ul>
  <div id="map-canvas" class="hidden"></div>
  <div class="profession-container hidden">
    <div class="gap"></div>
    @foreach($professions as $profession)
    @include('partials._profession-hud')
    @endforeach
  </div>
  <div class="batch-container">
    <div class="gap"></div>
    @foreach($batches as $batch)
    <div class="col-md-2 hud">
      <a href="{{URL::route('users.batch', $batch->id)}}"><span class="link-setter"></span></a>
      <div style="text-align:center;">
        <h3 class="hud-title" style="overflow:visible;padding-top:10px;font-size:14px;">{{$batch->value}}</h3>
      </div>
      <p class="hud-text" style="font-size:56px; overflow:visible;">{{$batch->users->count()}}</p>
    </div>
    @endforeach
  </div>
  <div class="branch-container hidden">
    <div class="gap"></div>
    @foreach($branches as $branch)
    <div class="col-md-2 hud">
      <a href="{{URL::route('users.branch', $branch->id)}}"><span class="link-setter"></span></a>
      <div style="text-align:center;">
        <h3 class="hud-title" style="overflow:visible;padding-top:10px;font-size:14px;">{{$branch->short}}</h3>
      </div>
      <p class="hud-text" style="font-size:56px; overflow:visible;">{{$branch->users->count()}}</p>
    </div>
    @endforeach
  </div>
  <div class="domain-container hidden">
    <div class="gap"></div>
    @foreach($domains as $domain)
    @include('partials._domain-hud')
    @endforeach
  </div>

</div>
@overwrite