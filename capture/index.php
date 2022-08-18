<?php
/*
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image Capture</title>
    <style>
        .button-group, .play-area {
            border: 1px solid grey;
            padding: 1em 1%;
            margin-bottom: 1em;
        }

        .button {
            padding: 0.5em;
            margin-right: 1em;
        }

        .play-area-sub {
            width: 47%;
            padding: 1em 1%;
            display: inline-block;
            text-align: center;
        }

        #capture {
            display: none;
        }

        #snapshot {
            display: inline-block;
            width: 320px;
            height: 240px;
        }
    </style>
    <script>
        // The buttons to start & stop stream and to capture the image
        var btnStart = document.getElementById( "btn-start" );
        var btnStop = document.getElementById( "btn-stop" );
        var btnCapture = document.getElementById( "btn-capture" );

        // The stream & capture
        var stream = document.getElementById( "stream" );
        var capture = document.getElementById( "capture" );
        var snapshot = document.getElementById( "snapshot" );

        // The video stream
        var cameraStream = null;

        // Attach listeners
        btnStart.addEventListener( "click", startStreaming );
        btnStop.addEventListener( "click", stopStreaming );
        btnCapture.addEventListener( "click", captureSnapshot );

        // Start Streaming
        function startStreaming() {

            var mediaSupport = 'mediaDevices' in navigator;

            if( mediaSupport && null == cameraStream ) {

                navigator.mediaDevices.getUserMedia( { video: true } )
                    .then( function( mediaStream ) {

                        cameraStream = mediaStream;

                        stream.srcObject = mediaStream;

                        stream.play();
                    })
                    .catch( function( err ) {

                        console.log( "Unable to access camera: " + err );
                    });
            }
            else {

                alert( 'Your browser does not support media devices.' );

                return;
            }
        }

        // Stop Streaming
        function stopStreaming() {

            if( null != cameraStream ) {

                var track = cameraStream.getTracks()[ 0 ];

                track.stop();
                stream.load();

                cameraStream = null;
            }
        }

        function captureSnapshot() {

            if( null != cameraStream ) {

                var ctx = capture.getContext( '2d' );
                var img = new Image();

                ctx.drawImage( stream, 0, 0, capture.width, capture.height );

                img.src		= capture.toDataURL( "image/png" );
                img.width	= 240;

                snapshot.innerHTML = '';

                snapshot.appendChild( img );
            }
        }
    </script>
</head>
<body>
<!-- The buttons to control the stream -->
<div class="button-group">
    <button id="btn-start" type="button" class="button">Start Streaming</button>
    <button id="btn-stop" type="button" class="button">Stop Streaming</button>
    <button id="btn-capture" type="button" class="button">Capture Image</button>
</div>

<!-- Video Element & Canvas -->
<div class="play-area">
    <div class="play-area-sub">
        <h3>The Stream</h3>
        <video id="stream" width="320" height="240"></video>
    </div>
    <div class="play-area-sub">
        <h3>The Capture</h3>
        <canvas id="capture" width="320" height="240"></canvas>
        <div id="snapshot"></div>
    </div>
</div>
</body>
</html>
