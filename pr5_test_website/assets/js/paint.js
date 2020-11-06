let canvas = document.getElementById('draw');
context = canvas.getContext("2d");

let chains = [];
let cleared = false;
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
	color = document.getElementById(isInternetExplorer ? "list-color" : "input-color").value;
	if (cleared) {
		chains = [];
		cleared = false;
	}
	chains.push({points: [mouseX, mouseY], color: color});
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

function redraw() {
	context.clearRect(0, 0, context.canvas.width, context.canvas.height);

	context.lineJoin = "round";
	context.lineWidth = 5;

	for (let i = 0; i < chains.length; i++) {
		points = chains[i].points;

		context.strokeStyle = chains[i].color;

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
	if (!cleared) {
		cleared = true;

		context.clearRect(0, 0, context.canvas.width, context.canvas.height);
	}
}

function canvas_undo() {
	if (cleared) {
		cleared = false;
	} else {
		chains.pop();
	}

	redraw();
}
