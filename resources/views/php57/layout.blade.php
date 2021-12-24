<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Layout</title>
</head>
<body>
<div class="wrapper">
	<header><h1>header</h1></header>
	<nav>
		<ul>
			<!-- lien quan den the a thi su dung ham url("duong dan ao") -->			
			<li><a href="{{ url('trangchu') }}">Trang chủ</a></li>
			<li><a href="{{ url('gioithieu') }}">Giới thiệu</a></li>
		</ul>
	</nav>
	<content>
		<aside><h1>Left</h1></aside>
		<article>
			<!-- do du lieu tu view vao day -->
			@yield("do-du-lieu-tu-view-vao-day")
		</article>
	</content>
	<footer><h1>Footer</h1></footer>
</div>
<style type="text/css">
	.wrapper{width: 1000px; margin: auto;}
	body,h1{padding: 0px; margin: 0px;}
	ul{padding: 0px; margin: 0px; list-style: none; line-height: 35px; background: black;}
	li{display: inline;}
	a{text-decoration: none; padding: 15px; color: white;}
	content{display: flex;}
	aside, article{height: 400px;}
	aside{background: yellow;width: 250px;}
	article{width: 750px;}
	header,footer{background: green;}
</style>
</body>
</html>