let canvas = document.getElementById('draw');
context = canvas.getContext("2d");

let clickX = new Array();
let clickY = new Array();
let clickDrag = new Array();
let clickColor = new Array();
let paint;
let mouseX;
let mouseY;

let offsetLeft = canvas.parentElement.offsetLeft;
let offsetTop  = canvas.parentElement.offsetTop;

let inputColor = document.getElementById("input-color");
let listColor = document.getElementById("list-color");

let isInternetExplorer = inputColor.value.length === 0

if (isInternetExplorer) {
	inputColor.style.display = "none";
	listColor.value = "#000000";
} else {
	listColor.style.display = "none";
}

canvas.addEventListener('mousedown', function (e) {
	mouseX = e.pageX - this.offsetLeft - offsetLeft;
	mouseY = e.pageY - this.offsetTop - offsetTop;
	paint = true;
	addClick(mouseX, mouseY);
	redraw();
});
canvas.addEventListener('mousemove', function (e) {
	if (paint) {
		addClick(e.pageX - this.offsetLeft - offsetLeft, e.pageY - this.offsetTop - offsetTop, true);
		redraw();
	}
});
canvas.addEventListener('mouseup', function (e) {
	paint = false;
});
canvas.addEventListener('mouseleave', function (e) {
	paint = false;
});

function addClick(x, y, dragging) {
	clickX.push(x);
	clickY.push(y);
	clickDrag.push(dragging);
	clickColor.push(document.getElementById(isInternetExplorer ? "list-color" : "input-color").value);
}

function redraw() {
	context.clearRect(0, 0, context.canvas.width, context.canvas.height);

	context.lineJoin = "round";
	context.lineWidth = 5;

	for (var i = 0; i < clickX.length; i++) {
		context.strokeStyle = clickColor[i];
		context.beginPath();
		if (clickDrag[i] && i) {
			context.moveTo(clickX[i - 1], clickY[i - 1]);
		} else {
			context.moveTo(clickX[i] - 1, clickY[i]);
		}
		context.lineTo(clickX[i], clickY[i]);
		context.closePath();
		context.stroke();
	}
}

function canvas_clear() {
	clickX = [];
	clickY = [];
	clickDrag = [];
	clickColor = [];

	context.clearRect(0, 0, context.canvas.width, context.canvas.height);
}
