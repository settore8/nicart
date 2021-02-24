<!--IUB_COOKIE_POLICY_START-->

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLEAPIKEY ?>"></script>

<script>
function initMap() {
var map;
var bounds = new google.maps.LatLngBounds();
var mapOptions = {
    mapTypeId: google.maps.MapTypeId.ROADMAP
};

// Display a map on the web page
map = new google.maps.Map(document.getElementById("mappaRivenditori"), mapOptions);
map.setTilt(50);
    
// Multiple markers location, latitude, and longitude
var markers = [
    <?php if (have_posts()) :  while (have_posts()) : the_post(); 
    $mappa = get_field('mappa'); ?>
    ['<?php the_title(); ?>', <?php echo $mappa['lat'].',' .$mappa['lng']; ?> ],
    <?php
    endwhile;  endif; ?>
];
                    
// Info window content
var infoWindowContent = [

    <?php if (have_posts()) :  while (have_posts()) : the_post(); 
    $remove[] = "'";
    $remove[] = '"';
    $remove[] = "-";
    
    $regione = str_replace( $remove, "", get_field('regione'));
    $indirizzo = str_replace( $remove, "", get_field('indirizzo'));
    $citta = str_replace( $remove, "", get_field('citta'));
    $location = get_field('mappa');
    $website = str_replace( $remove, "", get_field('website'));
    $tel = str_replace( $remove, "", get_field('telefono'));
    ?>
    ['<div class="info_content">' +
    '<h3><a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $location['lat']; ?>,<?php echo $location['lng'];?>" target="_blank"><?php the_title(); ?> </a></h3>' +
    '<h4> <?php echo $citta; ?> </h4>' +
    '<p><?php echo $indirizzo; ?></p>' +
   <?php if($website) { ?>
   ' <a href="<?php echo $website; ?>" target="_blank">sito web</a>' +
   <?php } ?> 
   <?php if($tel) { ?>
   ' <?php echo $tel; ?>' +
   <?php } ?> 
    '</div>'],
    <?php
    endwhile;  endif; ?>

];
    
// Add multiple markers to map
var infoWindow = new google.maps.InfoWindow(), marker, i;

// Place each marker on the map  
for( i = 0; i < markers.length; i++ ) {
    var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
    bounds.extend(position);
    marker = new google.maps.Marker({
        position: position,
        icon: '<?php imagesPath(); ?>/marker.png',
        map: map,
        title: markers[i][0]
    });
    
    // Add info window to marker    
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            infoWindow.setContent(infoWindowContent[i][0]);
            infoWindow.open(map, marker);
        }
    })(marker, i));

    // Center the map to fit all markers on the screen
    map.fitBounds(bounds);
}

// Set zoom level
var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
    this.setZoom(6);
    google.maps.event.removeListener(boundsListener);
});

}
// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);
</script>

<!--IUB_COOKIE_POLICY_END-->