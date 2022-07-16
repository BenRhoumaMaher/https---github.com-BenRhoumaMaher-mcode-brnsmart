<?php

    /* Template Name: forum Page */

session_start();
require 'C:\xampp\htdocs\brnsmart\wp-content\themes\rishi\include/db.php';
require 'C:\xampp\htdocs\brnsmart\wp-content\themes\rishi\include/functions.php';
require 'C:\xampp\htdocs\brnsmart\wp-content\themes\rishi\include/Session.php';

ConfirmerConnexionPersonneMorale();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <script
  		src="https://code.jquery.com/jquery-3.6.0.js"></script>
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
	  <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
	<title>Forum</title>
	<style type="text/css">
		.top_bar {
			width: 100%;
			height: 40px;
			background-color: #20aae5;
			border-bottom: 5px solid #1894ca;
			margin: 0 0 10px 0;
			display: inline-flex;
		}
	</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top">
  <div class="container">
    <a class="navbar-brand" href="#">
      <img src=" <?php require "uploads/logo.png"; ?>" >
    </a>
  </div>
</nav>
</body>
</html>