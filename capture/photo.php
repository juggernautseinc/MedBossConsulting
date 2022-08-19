<?php

/**
 *  package OpenEMR
 *  link    https://www.open-emr.org
 *  author  Sherwin Gaddis <sherwingaddis@gmail.com>
 *  Copyright (c) 2022.
 *  license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

if (!isset($_GET['source'])) {
    echo "Source not given. Contact link provider.";
   die;
}
if (!filter_input(INPUT_GET, 'source', FILTER_VALIDATE_INT)) {
    echo "Source not valid. Contact link provider.";
    die;
}
$patient_id = filter_input(INPUT_GET, 'source', FILTER_VALIDATE_INT);


?>
<!DOCTYPE html>
<html>
<head>
    <title>Demo - Capture Photo From Webcam Using Javascript</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <style type="text/css">

        button {
            width: 120px;
            padding: 10px;
            display: block;
            margin: 20px auto;
            border: 2px solid #111111;
            cursor: pointer;
            background-color: white;
        }

        #start-camera {
            margin-top: 50px;
        }

        #video {
            display: none;
            margin: 50px auto 0 auto;
        }

        #click-photo {
            display: none;
        }

        #dataurl-container {
            display: none;
        }

        #canvas {
            display: block;
            margin: 0 auto 20px auto;
        }

        #dataurl-header {
            text-align: center;
            font-size: 15px;
        }

        #dataurl {
            display: block;
            height: 100px;
            width: 320px;
            margin: 10px auto;
            resize: none;
            outline: none;
            border: 1px solid #111111;
            padding: 5px;
            font-size: 13px;
            box-sizing: border-box;
        }

    </style>
</head>

<body>

<button id="start-camera">Start Camera</button>
<video id="video" width="320" height="240" autoplay></video>
<button id="click-photo">Click Photo</button>
<div id="dataurl-container">
    <canvas id="canvas" width="320" height="240"></canvas>
    <div id="dataurl-header">Image Data URL</div>
    <textarea id="dataurl" readonly></textarea>
</div>

<script>

    let camera_button = document.querySelector("#start-camera");
    let video = document.querySelector("#video");
    let click_button = document.querySelector("#click-photo");
    let canvas = document.querySelector("#canvas");
    let dataurl = document.querySelector("#dataurl");
    let dataurl_container = document.querySelector("#dataurl-container");

    camera_button.addEventListener('click', async function() {
        let stream = null;

        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
        }
        catch(error) {
            alert(error.message);
            return;
        }

        video.srcObject = stream;

        video.style.display = 'block';
        camera_button.style.display = 'none';
        click_button.style.display = 'block';
    });

    click_button.addEventListener('click', function() {
        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
        let image_data_url = canvas.toDataURL('image/jpeg');

        dataurl.value = image_data_url;
        dataurl_container.style.display = 'block';
    });

</script>

</body>
</html>
