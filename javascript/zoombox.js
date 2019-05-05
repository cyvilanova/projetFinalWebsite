function magnify(imageID, zoom) {
  let img; //image to zoom in
  let zoombox; //zoombox
  let w;  //width of the image
  let h;  //height of the image
  let pixelBuffer =2; //pixelbuffer for the background

  img = document.getElementById(imageID);

  zoombox = document.createElement("DIV");
  zoombox.setAttribute("class", "img-zoombox");

  img.parentElement.insertBefore(zoombox,img);

  zoombox.style.backgroundImage = "url('" + img.src + "')";
  zoombox.style.backgroundRepeat = "no-repeat";
  zoombox.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";

  w = zoombox.offsetWidth / 2;
  h = zoombox.offsetHeight / 2;

  zoombox.addEventListener("mousemove", moveZoombox);

  img.addEventListener("mousemove", moveZoombox);

  zoombox.addEventListener("touchmove", moveZoombox);

  img.addEventListener("touchmove", moveZoombox);

  function moveZoombox(e) {
    let pos;
    let x;
    let y;

    e.preventDefault();

    pos = getPosCursor(e);
    x = pos.x;
    y = pos.y;

    if (x > img.width - (w / zoom)) {
      x = img.width - (w / zoom);
    }
    if (x < w / zoom) {
      x = w / zoom;
    }
    if (y > img.height - (h / zoom)) {
      y = img.height - (h / zoom);
    }
    if (y < h / zoom) {
      y = h / zoom;
    }

    zoombox.style.left = (x - w) + "px";
    zoombox.style.top = (y - h) + "px";

    zoombox.style.backgroundPosition = "-" + ((x * zoom) - w + pixelBuffer) + "px -" + ((y * zoom) - h + pixelBuffer) + "px";
  }

  function getPosCursor(e) {
    let a;
    let x = 0;
    let y = 0;

    e = e || window.event;

    a = img.getBoundingClientRect();

    x = e.pageX - a.left;
    y = e.pageY - a.top;

    x = x - window.pageXOffset;
    y = y - window.pageYOffset;
    return {x : x, y : y};
  }
}
