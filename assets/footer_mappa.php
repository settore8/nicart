<!--IUB_COOKIE_POLICY_START-->
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLEAPIKEY ?>"></script>
<script type="text/javascript">
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {
	
	var $markers = $el.find('.marker');
	
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP,
	};

	var map = new google.maps.Map( $el[0], args);
	
	map.markers = [];
	
	$markers.each(function(){
		
    	add_marker( $(this), map );
		
	});
	
	center_map( map );
	
	return map;
	
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	var image = '<?php bloginfo("template_url"); ?>/images/marker.png';
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map,
		icon		: image
	});

	map.markers.push( marker );

	if( $marker.html() )
	{
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	var bounds = new google.maps.LatLngBounds();

	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	if( map.markers.length == 1 )
	{
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
var map = null;
$(document).ready(function(){

	$('.acf-map').each(function(){
		map = new_map( $(this) );
	});
});

})(jQuery);
</script>
<!--IUB_COOKIE_POLICY_END-->