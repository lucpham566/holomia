$(document).ready(function () {
  // ----- carousel ----------
  $(".carousel").slick({
    dots: true,
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: "linear",
  });
  $(".carousel-banner").slick({
    infinite: true,
    dots: true,
    speed: 700,
    autoplay: true,
    autoplaySpeed: 2000,
  });
});
