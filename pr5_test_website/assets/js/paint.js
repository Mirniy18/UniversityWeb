let canvas = document.getElementById('draw');
context = canvas.getContext("2d");

let paint;
let mouseX;
let mouseY;

let chains = [];
let cleared = false;
let background;

let offsetLeft = canvas.parentElement.offsetLeft;
let offsetTop  = canvas.parentElement.offsetTop;

let inputColor = document.getElementById("input-color");
let listColor = document.getElementById("list-color");

let isInternetExplorer = inputColor.value.length === 0;

if (isInternetExplorer) {
	inputColor.style.display = "none";
	listColor.style.display = "";
	listColor.value = "#000000";

	document.getElementById("btn-save").style.display = "none";
}

canvas.addEventListener('mousedown', function (e) {
	mouseX = e.pageX - this.offsetLeft - offsetLeft;
	mouseY = e.pageY - this.offsetTop - offsetTop;
	paint = true;
	color = (isInternetExplorer ? listColor : inputColor).value;
	width = document.getElementById("range-width").value;

	if (cleared) {
		chains = [];
		cleared = false;
	}

	if (chains.length === 0) {
		document.getElementById("btn-clear").disabled = false;
		document.getElementById("btn-undo").disabled = false;
	}
	
	chains.push({points: [mouseX, mouseY], color: color, width: width});
	redraw();
});
canvas.addEventListener('mousemove', function (e) {
	if (paint) {
		addPoint(e.pageX - this.offsetLeft - offsetLeft, e.pageY - this.offsetTop - offsetTop);
		redraw();
	}
});
canvas.addEventListener('mouseup', function (e) {
	paint = false;
});
canvas.addEventListener('mouseleave', function (e) {
	paint = false;
});

function addPoint(x, y) {
	chains[chains.length - 1].points.push(x);
	chains[chains.length - 1].points.push(y);
}

function draw_background() {
	if (background != undefined) {
		if (background.width / background.height >= canvas.width / canvas.height) {
			background_width = background.width * (canvas.height / background.height);
	
			context.drawImage(background, (canvas.width - background_width) / 2, 0, background_width, canvas.height);
		} else {
			background_height = background.height * (canvas.width / background.width);
	
			context.drawImage(background, 0, (canvas.height - background_height) / 2, canvas.width, background_height);
		}
	}
}

function redraw() {
	context.clearRect(0, 0, context.canvas.width, context.canvas.height);

	draw_background();

	context.lineJoin = "round";
	context.lineWidth = 5;

	for (let i = 0; i < chains.length; i++) {
		points = chains[i].points;

		context.strokeStyle = chains[i].color;
		context.lineWidth = chains[i].width;

		if (points.length === 2) {
			context.beginPath();
			context.moveTo(points[0], points[1]);
			context.lineTo(points[0] + 1, points[1]);
			context.closePath();
			context.stroke();
		} else {
			for (let j = 0; j < points.length - 2; j += 2) {
				context.beginPath();
				context.moveTo(points[j], points[j + 1]);
				context.lineTo(points[j + 2], points[j + 3]);
				context.closePath();
				context.stroke();
			}
		}
	}
}

function canvas_clear() {
	cleared = true;

	context.clearRect(0, 0, context.canvas.width, context.canvas.height);

	draw_background();

	document.getElementById("btn-clear").disabled = true;
}

function canvas_undo() {
	if (cleared) {
		cleared = false;

		document.getElementById("btn-clear").disabled = false;
	} else {
		chains.pop();

		if (chains.length === 0) {
			document.getElementById("btn-undo").disabled = true;
			document.getElementById("btn-clear").disabled = true;
		}
	}

	redraw();
}

function set_background(src) {
	background = new Image();

	background.onload = function() {
		redraw();
	};

	background.src = src;

	document.getElementById("btn-bg-clear").disabled = false;
}

function set_background_file() {
	file = document.getElementById('file-background').files[0];

	if (file) {
		fileReader = new FileReader();

		fileReader.onloadend = function() {
			set_background(fileReader.result);
		};

		fileReader.readAsDataURL(file);
	}
}

function set_background_url() {
	set_background(document.getElementById('url-background').value);
}

function background_clear() {
	background = undefined;

	redraw();

	document.getElementById("btn-bg-clear").disabled = true;
}

function save() {
	let img = canvas.toDataURL("image/png").replace("image.png", "image/octet-stream");

	let lnk = document.getElementById("save-lnk");
	
	lnk.setAttribute("download", "canvas_image.png");
	lnk.setAttribute("href", img);

	lnk.click();
}
