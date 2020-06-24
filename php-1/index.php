<?php
    session_start();
    require_once "db.php";
    require_once 'util.php';
    $user = $_SESSION[AUTH];
    if (!isset($user)){
        header('Location: login.php');
    }
    $sql = "select * from products";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <style>
    *{
	-webkit-box-sizing: border-box;
  	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

.cf{
	zoom:1
}

.cf:before,.cf:after{
	content:"";
	display:table
}

.cf:after{
	clear:both
}

.fl-l{
	float:left
}

.fl-r{
	float:right
}

a{
	-webkit-transition:all 0.3s ease;
	-moz-transition:all 0.3s ease;
	-o-transition:all 0.3s ease;
	transition:all 0.3s ease;
}

html, body{
	background-color:#F2F2F2;
	font-family:Segoe, "Segoe UI", "DejaVu Sans", "Trebuchet MS", Verdana, sans-serif;
	margin:0;
	padding:0;
	height:100%;
	width:100%;
	text-align:center;
	color:#404040;
	position:relative;
}

.wrapper{
	list-style:none;
	margin:0;
	padding:0;
	width:790px;
	margin:30px auto 0;
	text-align:left;
}

.product{
	width:250px;
	margin-right:20px;
	background-color:#FFFFFF;
	position:relative;
}

.product:last-of-type{
	margin-right:0;
}

.container-prod{
	height:350px;
	overflow:hidden;
	position:relative;
	-moz-box-shadow: 0px 0px 0px 0px #F2F2F2;
	-webkit-box-shadow:  0px 0px 0px 0px #F2F2F2;
	box-shadow: 0px 0px 0px 0px #F2F2F2;
	-webkit-transition:all 0.3s ease;
	-moz-transition:all 0.3s ease;
	-o-transition:all 0.3s ease;
	transition:all 0.3s ease;
}

.container-prod:hover, .container-prod.information, .container-prod.social-sharing{
	-moz-box-shadow: 0px 0px 5px 0px #333;
	-webkit-box-shadow:  0px 0px 5px 0px #333;
	box-shadow: 0px 0px 5px 0px #333;
}

.image{
	height:270px;
	background-position:center;
	background-size:cover;
	background-repeat:no-repeat;
	-webkit-transition:all 1s ease;
	-moz-transition:all 1s ease;
	-o-transition:all 1s ease;
	transition:all 1s ease;
}

.information .image{
	height:150px;
}

.container-information{
	height:40px;
	overflow:hidden;
	-webkit-transition:all 1s ease;
	-moz-transition:all 1s ease;
	-o-transition:all 1s ease;
	transition:all 1s ease;
	background-color:#031E16;
	color:#FFFFFF;
}

.information .container-information{
	height:160px;
}

.container-information .title{
	height:40px;
	line-height:40px;
	padding:0 10px;
	background-color:#5DBA9D;
	color:#FFFFFF;
	font-size:20px;
	font-weight:bold;
	position:relative;
}

.close{
	width:40px;
	height:40px;
	text-align:center;
	line-height:40px;
	background-color:#11956c;
	position:absolute;
	right:-40px;
	-webkit-transition:all 1s ease;
	-moz-transition:all 1s ease;
	-o-transition:all 1s ease;
	transition:all 1s ease;
	color:#FFFFFF;
}

.information .close{
	right:0;
}

.container-information .description{
	padding:10px;
	height:120px;
	overflow-x:hidden;
	overflow-y:auto;
}

.sharing{
	text-align:center;
	width:100%;
	position:absolute;
	bottom:-50px;
	overflow:hidden;
	-webkit-transition:all 1s ease;
	-moz-transition:all 1s ease;
	-o-transition:all 1s ease;
	transition:all 1s ease;
	background-color:#031E16;
	z-index:1;
}

.social-sharing .sharing{
	bottom:40px;
}

.sharing a{
	color:#FFFFFF;
	font-size:20px;
	width:25%;
	height:40px;
	line-height:40px;
}

.sharing a:hover{
	color:#5DBA9D;
}


.buttons{
	position:relative;
	z-index:2;
}

.buttons a{
	text-align:center;
	width:25%;
	height:40px;
	line-height:40px;
	background-color:#11956c;
	color:#FFFFFF;
	text-decoration:none;
	position:relative;
	overflow:hidden;
}

.buttons a > span > span{
	position:relative;
	z-index:3;
	display:block;
	width:100%;
}

.buttons a > span:before{
	content:"";
	background-color:rgba(0,0,0,0);
	width:100%;
	height:40px;
	position:absolute;
	top:40px;
	left:0;
	z-index:1;
	-webkit-transition:all 0.3s ease;
	-moz-transition:all 0.3s ease;
	-o-transition:all 0.3s ease;
	transition:all 0.3s ease;
}

.buttons a:hover > span:before, .information .buttons a.more > span:before , .social-sharing .buttons a.share > span:before{
	top:0;
	background-color:rgba(0,0,0,0.5);
}

.information .buttons a.more > span:before , .social-sharing .buttons a.share > span:before{
	top:0;
	background-color:rgba(0,0,0,0.8);
}

.buttons a.cart.added > span:before{
	top:0;
	background-color:rgba(255,255,255,0.8);
}

.buttons a.cart > span > span.check{
	width:100%;
	height:40px;
	position:absolute;
	top:40px;
	left:0;
	-webkit-transition:all 0.3s ease;
	-moz-transition:all 0.3s ease;
	-o-transition:all 0.3s ease;
	transition:all 0.3s ease;
}

.buttons a.cart.added > span > span.check{
	top:0;
	color:#11956c;
}

.buttons a.cart > span > span.add{
	width:100%;
	height:40px;
	position:absolute;
	top:0;
	left:0;
	-webkit-transition:all 0.3s ease;
	-moz-transition:all 0.3s ease;
	-o-transition:all 0.3s ease;
	transition:all 0.3s ease;
}

.buttons a.cart.added > span > span.add{
	top:-40px;
}

.buttons a i{
	font-size:20px;
}

.buttons a:first-of-type{
	width:50%;
}
    </style>
    <title>Product</title>
</head>
<body>
                   
                    <?php foreach ($results as $key => $result) : ?>
                    <ul class="wrapper cf">
	<li class="product fl-l">
    	<div class="container-prod">
        	<div class="image" style="background-image:url('http://www.behoodclothing.com/wp-content/uploads/2012/07/Splatter.jpg');"></div>
            <div class="container-information">
            	<div class="title">
                    <?= $result['name'] ?>
                    <a href="javascript:void(0)" class="more close"><i class="fa fa-times"></i></a>                
                </div>
                <div class="description"><br>100% cotton<br>Color available: white on gray<br>Size available: L, XL</div>
            </div>
            <div class="sharing cf">
            	<a href="https://www.facebook.com/sharer/sharer.php?u=https://codepen.io/mattiabericchia/pen/myQNEV" class="fl-l" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="https://twitter.com/home?status=Example%20of%20UI%20for%20a%20product%20list%20made%20with%20jQuery%20and%20css%20tricks%20%40mattiabericchia%20https://codepen.io/mattiabericchia/pen/myQNEV" class="fl-l" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="https://plus.google.com/share?url=https://codepen.io/mattiabericchia/pen/myQNEV" class="fl-l" target="_blank"><i class="fa fa-google-plus"></i></a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://codepen.io/mattiabericchia/pen/myQNEV&title=UI%20Product%20list&summary=Example%20of%20UI%20for%20a%20product%20list%20made%20with%20jQuery%20and%20css%20tricks&source=https://www.linkedin.com/in/mattiabericchia" class="fl-l" target="_blank"><i class="fa fa-linkedin"></i></a>
            </div>
            <div class="buttons cf">
            	<a href="javascript:void(0)" class="cart fl-l">
                	<span>
                    	<span class="add"><?= $result['price'] ?></span>
                        <span class="check"><i class="fa fa-check"></i></span>
                   	</span>
                </a>
            	<a href="javascript:void(0)" class="more fl-l"><span><span><i class="fa fa-plus"></i></span></span></a>
            	<a href="javascript:void(0)" class="share fl-l"><span><span><i class="fa fa-share-alt"></span></i></span></a>
            </div>
        </div>
	</li>

</ul>
<?php endforeach; ?>
<script>
(function($) {
  $(".wrapper .more").click(function(show) {
    var showMe = $(this)
      .closest(".product")
      .find(".container-prod");
    $(this)
      .closest(".wrapper")
      .find(".container-prod")
      .not(showMe)
      .removeClass("information");
    $(".container-prod").removeClass("social-sharing");
    showMe
      .stop(false, true)
      .toggleClass("information")
      .removeClass("social-sharing");
    show.preventDefault();
  });

  $(".wrapper .share").click(function(share) {
    var showMe = $(this)
      .closest(".product")
      .find(".container-prod");
    $(this)
      .closest(".wrapper")
      .find(".container-prod")
      .not(showMe)
      .removeClass("social-sharing");
    $(".container-prod").removeClass("information");
    showMe
      .stop(false, true)
      .toggleClass("social-sharing")
      .removeClass("information");
    share.preventDefault();
  });

  $(".wrapper .add").click(function(share) {
    var showMe = $(this)
      .closest(".product")
      .find(".cart");
    showMe.stop(false, true).addClass("added");
    var showMe = $(this)
      .closest(".product")
      .find(".container-prod");
    showMe
      .stop(false, true)
      .removeClass("social-sharing")
      .removeClass("information");
    share.preventDefault();
  });
})(jQuery);


</script>
</body>
</html>
