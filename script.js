let map;
let autocomplete;
let autocompleteDestination;

const traveller_body = document.getElementById("traveller-body");

function openmap(){
    var map_button2 = document.getElementById("map-button2");
        if(document.getElementById("map-all").style.display == "none"||document.getElementById("map-all").style.display == ""){
            document.getElementById("map-all").style.display = "block";
            document.getElementById("no-map").style.display = "none";
            traveller_body.classList.toggle("withmap");
            map_button2.innerHTML = "Back";
        }
        else{
            document.getElementById("map-all").style.display = "none";
            document.getElementById("no-map").style.display = "block";
            traveller_body.classList.toggle("withmap");
            map_button2.innerHTML = "MAP";
        }
}

function initMap() {
            // Create the map centered on a default location
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 27.7172, lng: 85.3240 }, // Kathmandu, Nepal

                zoom: 13
            });


// new
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map); // Bind directions to the map
            directionsRenderer.setPanel(document.getElementById('directions-panel')); // Bind directions to a panel

            //new new

    // Add autocomplete for origin input
    const originInput = document.getElementById('origin-input');
    autocompleteOrigin = new google.maps.places.Autocomplete(originInput);
    autocompleteOrigin.bindTo('bounds', map);

    // Add autocomplete for destination input
    const destinationInput = document.getElementById('destination-input');
    autocompleteDestination = new google.maps.places.Autocomplete(destinationInput);
    autocompleteDestination.bindTo('bounds', map);

    // Handle place changes for origin
    autocompleteOrigin.addListener('place_changed', () => {
        const place = autocompleteOrigin.getPlace();
        if (!place.geometry) {
            console.log("No details available for the input: '" + place.name + "'");
            return;
        }

        // Adjust map view if desired
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
    });

    // Handle place changes for destination
    autocompleteDestination.addListener('place_changed', () => {
        const place = autocompleteDestination.getPlace();
        if (!place.geometry) {
            console.log("No details available for the input: '" + place.name + "'");
            return;
        }

        // Adjust map view if desired
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
    });





 
            const input = document.getElementById('pac-input');
 
            // Create the autocomplete object and bind it to the input field
            autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
 
            // Set up the event listener for when the user selects a place
            autocomplete.addListener('place_changed', () => {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    console.log("No details available for the input: '" + place.name + "'");
                    return;
                }
 
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17); // Zoom to 17 if the place has no viewport
                }
 
                // Place a marker on the selected location
                new google.maps.Marker({
                    position: place.geometry.location,
                    map: map
                });
            });
        }

//
        function getDirections() {
            const originInput = document.getElementById('origin-input').value;
            const destinationInput = document.getElementById('destination-input').value;
        
            if (!originInput || !destinationInput) {
                alert("Please enter both origin and destination.");
                return;
            }
        
            const request = {
                origin: originInput,
                destination: destinationInput,
                travelMode: google.maps.TravelMode.DRIVING // Can be DRIVING, WALKING, BICYCLING, TRANSIT
            };
        
            directionsService.route(request, (result, status) => {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(result); // Display directions on map
                } else {
                    alert("Directions request failed due to " + status);
                }
            });
        }
        