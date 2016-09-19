jQuery(".btn").click(function() {
  jQuery("#menu,.page_cover,html").addClass("open");
  window.location.hash = "#open";
});

window.onhashchange = function() {
  if (location.hash != "#open") {
    jQuery("#menu,.page_cover,html").removeClass("open");
  }
};