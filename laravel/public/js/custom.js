/*for google map start*/
function myMap() {
  var myCenter = new google.maps.LatLng(51.508742,-0.120850);
  var mapCanvas = document.getElementById("map");
  var mapOptions = {center: myCenter, zoom: 5};
  var map = new google.maps.Map(mapCanvas, mapOptions);
  var marker = new google.maps.Marker({position:myCenter});
  marker.setMap(map);
}
/*for google map end*/
/*sign up ,sign in and forget password login*/
$(document).ready(function(){
    $(".signupacnt").click(function(){
        $("#myModal").modal("hide");
        setTimeout(function(){ $("#signupmodal").modal("show");}, 500);
      });
    $(".loginacnt").click(function(){
        $("#signupmodal").modal("hide");
        setTimeout(function(){ $("#myModal").modal("show");}, 500);
      });
    $(".forget-pw").click(function(){
        $("#myModal").modal("hide");
        setTimeout(function(){ $("#forgetmyModal").modal("show");}, 500);
      });
  });
/*sign up ,sign in and forget password login*/