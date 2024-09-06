<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Radio FMR - live STREAM</title>
  <script src="./cpu-audio.js" async></script>
  <style>
    body{
      background-color: #555;
      margin: 0;
    }
    audio[controls] {
      display : block;
      width : 100%;
    }
  </style>
</head>

<body>
  
  
  <cpu-audio 
    title="Radio FMR"
    poster="https://radio-fmr.net/wp-content/themes/fmr/jplayer/skin/blue.monday/FMR_logo.png"
    canonical="https://radio-fmr.net/"
    duration="0"    
    >
    <audio controls id="audiodemo">
        <source src="http://stream.radio-fmr.net:8000/radio-fmr.mp3" type="audio/mpeg" />
    </audio>
</cpu-audio>
</body>
</html>
