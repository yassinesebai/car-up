$(document).ready(function() {
    $('.counter').counterUp({
        delay : 50,
        time: 2000
    })

    $('.customer-logos').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        dots: false,
        pauseOnHover:false,
        responsive: [{
            breakpoint: 768,
            setting: {
                slidesToShow: 3
            }
        }, {
            breakpoint: 520,
            setting: {
                slidesToShow: 2
            }
        }]
    });

        // MapBox Script 
    mapboxgl.accessToken = 'pk.eyJ1IjoieWFzc2luZXNzZWJhaSIsImEiOiJjbDF0bmhzbG0wNGU3M2ZvNXN6bGpzbDFjIn0.oj4GMVbfn8FfjNZP2wfXzg';
        var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-7.6172077414347, 33.57827472620312],
        zoom: 10
    });
    
})
//Get the button
let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}
// When the user clicks on the button, scroll to the top of the document
mybutton.addEventListener("click", backToTop);

function backToTop() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}