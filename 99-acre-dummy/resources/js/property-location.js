let map;
let marker;

window.initMap = function () {
console.log("initMap called");
const defaultLocation = { lat: 23.0225, lng: 72.5714 };

map = new google.maps.Map(
document.getElementById("map"),
{
zoom: 12,
center: defaultLocation
}
);

marker = new google.maps.Marker({
position: defaultLocation,
map: map,
draggable: true
});

updatePosition(defaultLocation);

marker.addListener("dragend", () => {

const pos = marker.getPosition();

updatePosition({
lat: pos.lat(),
lng: pos.lng()
});

});

initAutocomplete();

};
document.addEventListener("DOMContentLoaded", () => {



function updatePosition(pos){
document.getElementById("latitude").value = pos.lat;
document.getElementById("longitude").value = pos.lng;
}



function initAutocomplete(){

const cityInput = document.getElementById("city");
const localityInput = document.getElementById("locality");

if(!cityInput && !localityInput) return;

/* NEW GOOGLE PLACE AUTOCOMPLETE */

const cityAutocomplete =
new google.maps.places.PlaceAutocompleteElement();

cityAutocomplete.setAttribute("placeholder","Enter city");

cityInput.parentNode.replaceChild(cityAutocomplete, cityInput);


const localityAutocomplete =
new google.maps.places.PlaceAutocompleteElement();

localityAutocomplete.setAttribute("placeholder","Enter locality");

localityInput.parentNode.replaceChild(localityAutocomplete, localityInput);


cityAutocomplete.addEventListener("gmp-select", async (event) => {

const place = event.placePrediction.toPlace();

await place.fetchFields({
fields:["location","displayName"]
});

if(place.location){

map.setCenter(place.location);

marker.setPosition(place.location);

updatePosition({
lat: place.location.lat(),
lng: place.location.lng()
});

}

});


localityAutocomplete.addEventListener("gmp-select", async (event) => {

const place = event.placePrediction.toPlace();

await place.fetchFields({
fields:["location","displayName"]
});

if(place.location){

map.setCenter(place.location);

marker.setPosition(place.location);

updatePosition({
lat: place.location.lat(),
lng: place.location.lng()
});

}

});

}


/* DETECT USER LOCATION */

const detectBtn = document.getElementById("detectLocation");

if(detectBtn){

detectBtn.addEventListener("click", () => {

if(!map){
console.error("Map not initialized yet");
return;
}
if(navigator.geolocation){

navigator.geolocation.getCurrentPosition((position)=>{

const lat = position.coords.latitude;
const lng = position.coords.longitude;

const pos = {lat,lng};

map.setCenter(pos);
marker.setPosition(pos);

updatePosition(pos);

});

}

});

}

});