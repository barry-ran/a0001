//初始化调用
window.onload = function() {
	//配置
	var config = {
		vx: 4, //小球x轴速度,正为右，负为左
		vy: 4, //小球y轴速度
		height: 2, //小球高宽，其实为正方形，所以不宜太大
		width: 2,
		count: 30, //点个数
		color: "255, 255, 255", //点颜色
		stroke: "255,255,255", //线条颜色
		dist: 6000, //点吸附距离
		e_dist: 20000, //鼠标吸附加速距离
		max_conn: 2 //点到点最大连接数
	}
	//调用
	CanvasParticle(config);
}
var CanvasParticle = (function() {
	function getElementByTag(name) {
		return document.getElementsByTagName(name);
	}

	function getELementById(id) {
		return document.getElementById(id);
	}

	function canvasInit(canvasConfig) {
		canvasConfig = canvasConfig || {};
		var html = getElementByTag("html")[0];
		// mydiv是你想要将其作为背景的div的ID
		var body = document.getElementById("mydiv");
		var canvasObj = document.createElement("canvas");
		var canvas = {
			element: canvasObj,
			points: [],
			config: {
				vx: canvasConfig.vx,
				vy: canvasConfig.vy,
				height: canvasConfig.height,
				width: canvasConfig.width,
				count: canvasConfig.count,
				color: canvasConfig.color,
				stroke: canvasConfig.stroke,
				dist: canvasConfig.dist,
				e_dist: canvasConfig.e_dist,
				max_conn: 2
			}
		};
		if(canvas.element.getContext("2d")) {
			canvas.context = canvas.element.getContext("2d");
		} else {
			return null;
		}
		body.style.padding = "0";
		body.style.margin = "0";
		body.appendChild(canvas.element);
		canvas.element.style = "position: absolute; top: 0; left: 0; z-index: -1;";
		canvasSize(canvas.element);
		window.onresize = function() {
			canvasSize(canvas.element);
		}
		body.onmousemove = function(e) {
			var event = e || window.event;
			canvas.mouse = {
				x: event.clientX,
				y: event.clientY
			}
		}
		document.onmouseleave = function() {
			canvas.mouse = undefined;
		}
		setInterval(function() {
			drawPoint(canvas);
		}, 40);
	}

	function canvasSize(canvas) {
		var width = document.getElementById("mydiv").offsetWidth;
		var height = document.getElementById("mydiv").style.height;
		width = parseInt(width);
		height = parseInt(height);
		canvas.width = width || window.innerWeight || document.documentElement.clientWidth || document.body.clientWidth;
		canvas.height = height || window.innerWeight || document.documentElement.clientHeight || document.body.clientHeight;
	}

	function drawPoint(canvas) {
		var context = canvas.context,
			point,
			dist;
		context.clearRect(0, 0, canvas.element.width, canvas.element.height);
		context.beginPath();
		context.fillStyle = "rgb(" + canvas.config.color + ")";
		for(var i = 0, len = canvas.config.count; i < len; i++) {
			if(canvas.points.length != canvas.config.count) {
				point = {
					x: Math.floor(Math.random() * canvas.element.width),
					y: Math.floor(Math.random() * canvas.element.height),
					vx: canvas.config.vx / 2 - Math.random() * canvas.config.vx,
					vy: canvas.config.vy / 2 - Math.random() * canvas.config.vy
				}
			} else {
				point = borderPoint(canvas.points[i], canvas);
			}
			context.fillRect(point.x - canvas.config.width / 2, point.y - canvas.config.height / 2, canvas.config.width, canvas.config.height);
			canvas.points[i] = point;
		}
		drawLine(context, canvas, canvas.mouse);
		context.closePath();
	}

	function borderPoint(point, canvas) {
		var p = point;
		if(point.x <= 0 || point.x >= canvas.element.width) {
			p.vx = -p.vx;
			p.x += p.vx;
		} else if(point.y <= 0 || point.y >= canvas.element.height) {
			p.vy = -p.vy;
			p.y += p.vy;
		} else {
			p = {
				x: p.x + p.vx,
				y: p.y + p.vy,
				vx: p.vx,
				vy: p.vy
			}
		}
		return p;
	}

	function drawLine(context, canvas, mouse) {
		context = context || canvas.context;
		for(var i = 0, len = canvas.config.count; i < len; i++) {
			canvas.points[i].max_conn = 0;
			for(var j = 0; j < len; j++) {
				if(i != j) {
					dist = Math.round(canvas.points[i].x - canvas.points[j].x) * Math.round(canvas.points[i].x - canvas.points[j].x) +
						Math.round(canvas.points[i].y - canvas.points[j].y) * Math.round(canvas.points[i].y - canvas.points[j].y);
					if(dist <= canvas.config.dist && canvas.points[i].max_conn < canvas.config.max_conn) {
						canvas.points[i].max_conn++;
						context.lineWidth = 0.5 - dist / canvas.config.dist;
						context.strokeStyle = "rgba(" + canvas.config.stroke + "," + (1 - dist / canvas.config.dist) + ")"
						context.beginPath();
						context.moveTo(canvas.points[i].x, canvas.points[i].y);
						context.lineTo(canvas.points[j].x, canvas.points[j].y);
						context.stroke();

					}
				}
			}

		}
	}
	return canvasInit;
})();