<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
<link href="StyleSheet.css" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" media="all" />
<style>
h1 {
    position: relative;
    left: 470px;
    top: 150px;
	font-size: 150%;
}
.u {
position: absolute;
    right: 5px;
    bottom: 30px;
}
</style>
  </head>
  <body bgcolor="#E6E6FA">
        <b><h1>I am going to donate blood Please wait.....</h1></b>
	<div class="u"><img src="h.png" style="width:204px;height:180px;"></div>
	<img src="logonew.png" style="width:184px;height:160px;">
    <canvas id="canvas" width="1200" height="400"></canvas>


    <script src="./utils.js"></script>
    <script src="./segment.js"></script>
    <script src="./slider.js"></script>
    <script>
    window.onload = function () {
      var canvas = document.getElementById('canvas'),
          context = canvas.getContext('2d'),
          segment0 = new Segment(50, 15),
          segment1 = new Segment(50, 10),
          segment2 = new Segment(50, 15),
          segment3 = new Segment(50, 10),
          speedSlider = new Slider(0, 1.2, 0.18),
          thighRangeSlider = new Slider(0, 90, 45),
          thighBaseSlider = new Slider(0, 180, 90),
          calfRangeSlider = new Slider(0, 90, 45),
          calfOffsetSlider = new Slider(-3.14, 3.14, -1.57),
          gravitySlider = new Slider(0, 1, 0.2),
          cycle = 0,
          vx = 0,
          vy = 0;
      
      segment0.x = 200;
      segment0.y = 200;
      
      segment1.x = segment0.getPin().x;
      segment1.y = segment0.getPin().y;

      segment2.x = 200;
      segment2.y = 200;
      
      segment3.x = segment2.getPin().x;
      segment3.y = segment2.getPin().y;

      /*speedSlider.x = 10;
      speedSlider.y = 10;
      speedSlider.captureMouse(canvas);

      thighRangeSlider.x = 30;
      thighRangeSlider.y = 10;
      thighRangeSlider.captureMouse(canvas);

      thighBaseSlider.x = 50;
      thighBaseSlider.y = 10;
      thighBaseSlider.captureMouse(canvas);

      calfRangeSlider.x = 70;
      calfRangeSlider.y = 10;
      calfRangeSlider.captureMouse(canvas);

      calfOffsetSlider.x = 90;
      calfOffsetSlider.y = 10;
      calfOffsetSlider.captureMouse(canvas);

      gravitySlider.x = 110;
      gravitySlider.y = 10;
      gravitySlider.captureMouse(canvas);*/

      function setVelocity () {
        vy += gravitySlider.value;
        segment0.x += vx;
        segment0.y += vy;
        segment2.x += vx;
        segment2.y += vy;
      }
      
      function walk (segA, segB, cyc) {
        var angle0 = (Math.sin(cyc) * thighRangeSlider.value + thighBaseSlider.value) * Math.PI / 180,
            angle1 = (Math.sin(cyc + calfOffsetSlider.value) * calfRangeSlider.value + calfRangeSlider.value) * Math.PI / 180,
            foot = segB.getPin();

        segA.rotation = angle0;
        segB.rotation = segA.rotation + angle1;
        segB.x = segA.getPin().x;
        segB.y = segA.getPin().y;
        segB.vx = segB.getPin().x - foot.x;
        segB.vy = segB.getPin().y - foot.y;
      }

      function checkFloor (seg) {
        var yMax = seg.getPin().y + (seg.height / 2);
        if (yMax > canvas.height) {
          var dy = yMax - canvas.height;
          segment0.y -= dy;
          segment1.y -= dy;
          segment2.y -= dy;
          segment3.y -= dy;
          vx -= seg.vx;
          vy -= seg.vy;
        }
      }
      
      function checkWalls () {
        var w = canvas.width + 200;
        if (segment0.x > canvas.width + 100) {
          segment0.x -= w;
          segment1.x -= w;
          segment2.x -= w;
          segment3.x -= w;
        }
	  if (segment0.x<0) {
          window.open("./index.php","_self");
        }
      }

      (function drawFrame () {
        window.requestAnimationFrame(drawFrame, canvas);
        context.clearRect(0, 0, canvas.width, canvas.height);
        
        cycle += speedSlider.value;
        setVelocity();
        walk(segment0, segment1, cycle);
        walk(segment2, segment3, cycle + Math.PI);
        checkFloor(segment1);
        checkFloor(segment3);
        checkWalls();
        
        segment0.draw(context);
        segment1.draw(context);
        segment2.draw(context);
        segment3.draw(context);
        //speedSlider.draw(context);
        //thighRangeSlider.draw(context);
        //thighBaseSlider.draw(context);
        //calfRangeSlider.draw(context);
        //calfOffsetSlider.draw(context);
        //gravitySlider.draw(context);
      }());
    };
    </script>
  </body>
</html>
