<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HTML5 Media Device Access</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    video, img {
      max-width:100%;
    }
  </style>
</head>
<body>

<video autoplay></video>

<script>

  (function() {
    'use strict';
    var video = document.querySelector('video')
      , canvas;

    /**
     *  generates a still frame image from the stream in the <video>
     *  appends the image to the <body>
     */
    function takeSnapshot() {
      var img = document.querySelector('img') || document.createElement('img');
      var context;
      var width = video.offsetWidth
        , height = video.offsetHeight;

      canvas = canvas || document.createElement('canvas');
      canvas.width = width;
      canvas.height = height;

      context = canvas.getContext('2d');
      context.drawImage(video, 0, 0, width, height);

      img.src = canvas.toDataURL('image/png');
      document.body.appendChild(img);
    }

    // use MediaDevices API
      if (navigator.mediaDevices) {
      // access the web cam
      navigator.mediaDevices.getUserMedia({video: true})
      // permission granted:
        .then(function(stream) {
          video.srcObject = stream;
          video.addEventListener('click', takeSnapshot);
        })
        // permission denied:
        .catch(function(error) {
          document.body.textContent = 'Could not access the camera. Error: ' + error.name;
        });
    }
  })();

</script>

</body>
</html>
