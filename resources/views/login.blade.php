<!DOCTYPE html>
<html>
<head>
	<title>教学考勤 | 登录</title>
	<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/other/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" type="text/css" href="/other/admin.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta charset="utf-8">
	<style type="text/css">
		.login, .register{/*background-image: url("//o4sjkq0di.qnssl.com/img/deep-login-bg.jpg");*/background-image:none;background-color: #17181c;padding: 0px;}
		.panel-dark>.panel-heading {background-color: #1c94c7;border-color: #1878A2;}
		.btn-primary{background-color: #4a89dc;border-color: #4279C2;}
		.btn-primary:HOVER{background-color: #5397F1;border-color: #5091E7;}
	</style>
</head>
<body class="login">
    <div class="row row-table page-wrapper" style="position: absolute;">
    <canvas></canvas>
      <div class="col-lg-3 col-md-6 col-sm-8 col-xs-12 align-middle">
         <!-- START panel-->
         <div data-toggle="play-animation" data-play="fadeIn" data-offset="0" class="panel panel-dark panel-flat anim-running anim-done" style="">
            <div class="panel-heading text-center">
               <a href='/index.php'>
               <h3 class="text-center mt-lg" style="color: #fff">
                  <strong>教学考勤 登录</strong>
               </h3>
               </a>
            </div>
            <div class="panel-body">
               <form role="form" class="mb-lg login-validate" method="post" action="/login">
               	{{ csrf_field() }}
                  <div class="form-group has-feedback">
                     <input id="user-name-email" name="username" type="text" placeholder="学号/工号或Email" value="" class="form-control required">
                     
                  </div>
                  <div class="form-group has-feedback">
                     <input id="password" name="password" type="password" placeholder="登录密码" value="" class="form-control required">
                    
                  </div>
                  <div class="form-group has-feedback">
                      <div id="captcha"></div>
                  </div>
                  <div class="clearfix">
                     <div class="pull-right"><a href="#" title="请联系管理员" class="text-muted"><small>忘记密码?</small></a>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-block btn-primary" id="login-submit-btn">登录</button>
                  @if (session('error'))
                    <div class="alert alert-danger alert-dismissable" style="margin-top: 20px">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> 用户名或密码有误，登录失败</h4>
                  </div>
                  @endif
                                 </form>
            </div>
         </div>
         <!-- END panel-->
      </div>
   </div>
</body>
<script type="text/javascript" src="/other/jquery2.1.min.js"></script>
<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/other/jquery.validate.js"></script>
<script type="text/javascript" src="/other/jquery.metadata.js"></script>
<script type="text/javascript" src="/other/gt.js"></script>
<script type="text/javascript">
try{
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
       
    }else{
      $(function(){
  var canvas = document.querySelector('canvas'),
      ctx = canvas.getContext('2d')
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  ctx.lineWidth = .3;
  ctx.strokeStyle = (new Color(150)).style;

  var mousePosition = {
    x: 30 * canvas.width / 100,
    y: 30 * canvas.height / 100
  };

  var dots = {
    nb: 250,
    distance: 100,
    d_radius: 150,
    array: []
  };

  function colorValue(min) {
    return Math.floor(Math.random() * 255 + min);
  }
  
  function createColorStyle(r,g,b) {
    return 'rgba(' + r + ',' + g + ',' + b + ', 0.8)';
  }
  
  function mixComponents(comp1, weight1, comp2, weight2) {
    return (comp1 * weight1 + comp2 * weight2) / (weight1 + weight2);
  }
  
  function averageColorStyles(dot1, dot2) {
    var color1 = dot1.color,
        color2 = dot2.color;
    
    var r = mixComponents(color1.r, dot1.radius, color2.r, dot2.radius),
        g = mixComponents(color1.g, dot1.radius, color2.g, dot2.radius),
        b = mixComponents(color1.b, dot1.radius, color2.b, dot2.radius);
    return createColorStyle(Math.floor(r), Math.floor(g), Math.floor(b));
  }
  
  function Color(min) {
    min = min || 0;
    this.r = colorValue(min);
    this.g = colorValue(min);
    this.b = colorValue(min);
    this.style = createColorStyle(this.r, this.g, this.b);
  }

  function Dot(){
    this.x = Math.random() * canvas.width;
    this.y = Math.random() * canvas.height;

    this.vx = -.5 + Math.random();
    this.vy = -.5 + Math.random();

    this.radius = Math.random() * 2;

    this.color = new Color();
    //console.log(this);
  }

  Dot.prototype = {
    draw: function(){
      ctx.beginPath();
      ctx.fillStyle = this.color.style;
      ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false);
      ctx.fill();
    }
  };

  function createDots(){
    for(i = 0; i < dots.nb; i++){
      dots.array.push(new Dot());
    }
  }

  function moveDots() {
    for(i = 0; i < dots.nb; i++){

      var dot = dots.array[i];

      if(dot.y < 0 || dot.y > canvas.height){
        dot.vx = dot.vx;
        dot.vy = - dot.vy;
      }
      else if(dot.x < 0 || dot.x > canvas.width){
        dot.vx = - dot.vx;
        dot.vy = dot.vy;
      }
      dot.x += dot.vx;
      dot.y += dot.vy;
    }
  }

  function connectDots() {
    for(i = 0; i < dots.nb; i++){
      for(j = 0; j < dots.nb; j++){
        i_dot = dots.array[i];
        j_dot = dots.array[j];

        if((i_dot.x - j_dot.x) < dots.distance && (i_dot.y - j_dot.y) < dots.distance && (i_dot.x - j_dot.x) > - dots.distance && (i_dot.y - j_dot.y) > - dots.distance){
          if((i_dot.x - mousePosition.x) < dots.d_radius && (i_dot.y - mousePosition.y) < dots.d_radius && (i_dot.x - mousePosition.x) > - dots.d_radius && (i_dot.y - mousePosition.y) > - dots.d_radius){
            ctx.beginPath();
            ctx.strokeStyle = averageColorStyles(i_dot, j_dot);
            ctx.moveTo(i_dot.x, i_dot.y);
            ctx.lineTo(j_dot.x, j_dot.y);
            ctx.stroke();
            ctx.closePath();
          }
        }
      }
    }
  }

  function drawDots() {
    for(i = 0; i < dots.nb; i++){
      var dot = dots.array[i];
      dot.draw();
    }
  }

  function animateDots() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    moveDots();
    connectDots();
    drawDots();

    requestAnimationFrame(animateDots);	
  }

  $('canvas').on('mousemove', function(e){
    mousePosition.x = e.pageX;
    mousePosition.y = e.pageY;
  });

  $('canvas').on('mouseleave', function(e){
    mousePosition.x = canvas.width / 2;
    mousePosition.y = canvas.height / 2;
  });

  createDots();
  requestAnimationFrame(animateDots);	
});
    }
}catch(e){}
</script>
</html>