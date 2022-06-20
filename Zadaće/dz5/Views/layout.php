<!DOCTYPE html>
<html lang="">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        <?php include 'index.css'; ?>
    </style>
    <title>MVC HR Schema</title>
</head>
<body style="">


<nav id="navBar">
		<div id="navAppName">
			<span>NorthWind</span>
			<img src="../icons/northwind.png" id="navLogo"> 
		</div>
		<ul id="navList">
        <a href="products" class="button-link">Proizvodi</a>
        <a href="categories" class="button-link">Kategorije</a>
        <a href="suppliers" class="button-link">Dobavljači</a>
		</ul>
	</nav>
<div class="menu">

</div>

<div class="main">


<?php require_once('Routes.php')?>


</div>

</body>
</html>
