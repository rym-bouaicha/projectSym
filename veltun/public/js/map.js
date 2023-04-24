var map = L.map('map').setView([51.505, -0.09], 13);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 18,
}).addTo(map);
var locations = [
    {lat: 51.5, lng: -0.09, name: 'Location 1'},
    {lat: 51.51, lng: -0.1, name: 'Location 2'},
    {lat: 51.49, lng: -0.05, name: 'Location 3'},
];

for (var i = 0; i < locations.length; i++) {
    var location = locations[i];
    var marker = L.marker([location.lat, location.lng]).addTo(map);
    marker.bindPopup(location.name);
}
