$(document).ready(function () {
    // Handle the initial Umrah planning question
    $('#plan-umrah-yes').click(function () {
        $('#plan-flight-section').removeClass('d-none');
    });

    $('#plan-umrah-no').click(function () {
        alert('You have chosen not to plan your Umrah.');
    });

    // Handle the flight planning question
    $('#plan-flight-yes').click(function () {
        $('#flight-details-section').removeClass('d-none');
        $('#hotels-section').removeClass('d-none');
    });

    $('#plan-flight-no').click(function () {
        $('#hotels-section').removeClass('d-none');
    });

    // Handle hotel reservation (example)
    $('.btn-primary').click(function () {
        alert('Hotel reserved successfully!');
        $('#map-section').removeClass('d-none');
    });

    // Initialize the map (example using Google Maps API)
    function initMap() {
        var makkah = { lat: 21.4225, lng: 39.8262 };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: makkah
        });

        // Add markers and event listeners for planning days
        var marker = new google.maps.Marker({
            position: makkah,
            map: map,
            title: 'Makkah'
        });

        marker.addListener('click', function () {
            var contentString = '<div id="content">' +
                '<h5>Plan Your Day</h5>' +
                '<button class="btn btn-primary" onclick="planUmrahDay()">Plan Umrah Day</button>' +
                '<button class="btn btn-secondary" onclick="planHistoricalVisitDay()">Plan Historical Visit Day</button>' +
                '</div>';

            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });

            infowindow.open(map, marker);
        });
    }

    // Load the map script dynamically
    var script = document.createElement('script');
    script.src = 'https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap';
    script.async = true;
    document.head.appendChild(script);
});

// Functions to handle day planning
function planUmrahDay() {
    alert('Umrah day planned!');
}

function planHistoricalVisitDay() {
    alert('Historical visit day planned!');
}