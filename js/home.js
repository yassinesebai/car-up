$(document).ready(function () {
  $(".owl-carousel").owlCarousel({
    items: 1,
    loop: true,
    dots: true,
    autoplay: true,
    autoplaySpeed: 1000,
    smartSpeed: 1500,
    autoplayHoverPause: true,
  });

  $(".counter").counterUp({
    delay: 50,
    time: 2000,
  });

  $(".customer-logos").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    dots: false,
    pauseOnHover: false,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 3,
        },
      },
      {
        breakpoint: 520,
        settings: {
          slidesToShow: 2,
        },
      },
    ],
  });

  $(".navbarlink").click(function () {
    $(".navbarlink").removeClass("currentItem");
    $(this).addClass("currentItem");
  });

  // MapBox Script
  mapboxgl.accessToken =
    "pk.eyJ1IjoieWFzc2luZXNzZWJhaSIsImEiOiJjbDF0bmhzbG0wNGU3M2ZvNXN6bGpzbDFjIn0.oj4GMVbfn8FfjNZP2wfXzg";
  var map = new mapboxgl.Map({
    container: "map",
    style: "mapbox://styles/mapbox/streets-v11",
    center: [-7.6172077414347, 33.57827472620312],
    zoom: 10,
  });

  $("#submit").click(function (e) {
    e.preventDefault();
    var fullname = $("#fullname").val();
    var email = $('input[name="email"]').val();
    var msg = $("#message").val();
    if (
      fullname != "" &&
      /^[a-z]+(\s)[a-z]+$/i.test(fullname) &&
      email != "" &&
      /^[a-z0-9]+@[a-z]+\.[a-z]{2,3}$/i.test(email) &&
      msg != ""
    ) {
      $.ajax({
        url: "contact.php",
        type: "POST",
        data: {
          fullname: fullname,
          email: email,
          message: msg,
        },
        success: function (msg) {
          if (msg == "yes") {
            $("#error").html("");
            $("#contact-form")[0].reset();
            Swal.fire(
              "Message sent !",
              "We will respond as soon as possible",
              "success"
            );
          } else {
            Swal.fire("Message not sent !", "Please try again later", "error");
          }
        },
      });
    } else {
      $("#error").html(
        '<i class="fa-solid fa-circle-exclamation px-2"></i>Error ! please enter valid informations '
      );
    }
  });
});
//Get the button
let mybutton = document.getElementById("btn-back-to-top");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
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
