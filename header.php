<?php
ob_start();
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Book library</title>
<link href="layout.css" rel="stylesheet" type="text/css" />

</head>

<body>


<div style="width:100%;text-align:center;">
<img src="header.jpg" alt="Books header">

<div style="color:red">
<h2><b>Μy E-library</b></h2><h3> Θέλετε να αποθηκεύετε τα αγαπημένα σας βιβλία σε ηλεκτρονική βιβλιοθήκη; <a href="signup.php">Κάντε εγγραφή τώρα!</a></h3>
</div>
</div>

</body>
</html>
