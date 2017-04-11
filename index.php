<html>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.5/p5.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.5/addons/p5.dom.js"></script>
	<script src="../lib/p5.speech.js"></script>
	<script>

	var myRec = new p5.SpeechRec(); // new P5.SpeechRec object
	myRec.continuous = true; // do continuous recognition
	myRec.interimResults = true; // allow partial recognition (faster, less accurate)

	var x, y;
	var dx, dy;

	function setup()
	{
		// graphics stuff:
		createCanvas(800, 600);
		background(255, 255, 255);
		fill(0, 0, 0, 255);
		x = width/2;
		y = height/2;
		dx = 0;
		dy = 0;

		// instructions:
		textSize(20);
		textAlign(LEFT);
		text("위쪽, 아래쪽, 왼쪽, 오른쪽, 멈춰, 리셋, 작동법", 20, 20);

		myRec.onResult = parseResult; // recognition callback
		myRec.start(); // start engine
	}

	function draw()
	{
		ellipse(x, y, 5, 5);
		x+=dx;
		y+=dy;
		if(x<0) x = width;
		if(y<0) y = height;
		if(x>width) x = 0;
		if(y>height) y = 0;
	}

	function parseResult()
	{
		// recognition system will often append words into phrases.
		// so hack here is to only use the last word:
		var mostrecentword = myRec.resultString.split(' ').pop();
		if(mostrecentword.indexOf("왼쪽")!==-1) { dx=-1;dy=0; }
		else if(mostrecentword.indexOf("오른쪽")!==-1) { dx=1;dy=0; }
		else if(mostrecentword.indexOf("위쪽")!==-1) { dx=0;dy=-1; }
		else if(mostrecentword.indexOf("아래쪽")!==-1) { dx=0;dy=1; }
		else if(mostrecentword.indexOf("멈춰")!==-1) { dx=0;dy=0; }
		else if(mostrecentword.indexOf("작동법")!==-1) { text("위쪽, 아래쪽, 왼쪽, 오른쪽, 멈춰, 리셋, 작동법", 20, 20); }
    else if(mostrecentword.indexOf("samba")!==-1) { window.open("https://youtu.be/kk4uddaHdDE?t=1m18s") }
		else if(mostrecentword.indexOf("쌈바")!==-1) { window.open("https://youtu.be/kk4uddaHdDE?t=1m18s") }
		else if(mostrecentword.indexOf("리셋")!==-1) { background(255); }
		// else if(mostrecentword.indexOf("멈춤")!==-1) { dx=0;dy=0; }
		console.log(mostrecentword);
	}

</script>
</head>
<body>
</body>
</html>
