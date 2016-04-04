$( document ).ready(function() {
  $("body").keydown(function(e) {

    if(e.keyCode == 37) { // left
          window.location.replace(document.getElementById('prev').href);
    }
    else if(e.keyCode == 39) { // right
      window.location.replace(document.getElementById('next').href);
    }
  });
});