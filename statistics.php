<?php 
include 'header.php';
include 'footer.php';
include 'menu.php';
include 'bookssearch.php';
session_start();
$regValue = $_GET['name'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Statistics</title>
<link href="layout.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id = "countAuthor">
<h2>Στατιστικά για τον Συγγραφέα</h2>
Αριθμός βιβλίων που έχουν εκδοθεί: <h1 id="volumes" > </h1>
</div>


<p id="demo"></p>

<p><?php echo 'Συγγραφέας : '.$regValue ?></p>

<p><?php
    $bookcl = new bookcl();
	$json1 = $bookcl->getBooks($regValue, 40);
	//echo $json1['totalItems'];
	$test = $_COOKIE['totItems'];
	$json2 = $bookcl->getBooks($regValue, $test);
	//print_r($json1);
	$c_items = NULL;
	foreach($json2['items'] as $key1=>$a){
			if ($bookcl->findKey($json2['items'][$key1]['volumeInfo'],'averageRating')==true){
			//echo $json2['items'][$key1]['volumeInfo']['averageRating'];
			if ($json2['items'][$key1]['volumeInfo']['averageRating'] >= 4){
				$c_items = $c_items +1;
			}
			echo '  ';
			}
	}
	echo ($c_items.' βιβλία ψηφίστηκαν με μέσο όρο > 4 αστεράκια');
	?>  </p>

<script>


var request = new XMLHttpRequest();
var mr = 40; //Καλούμε το json με maxResults=40
var stidx=0;

calljson(mr,stidx);


request.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	var myObj = JSON.parse(this.responseText); // Στο myObj ειναι αποθηκευμένο 
		var totitems = myObj.totalItems;
		document.getElementById("volumes").innerHTML = totitems;
		var results = [];
		var searchField = "averageRating";
		var searchVal = "4";
		for (var i=0 ; i < myObj.items.length ; i++){
			if (myObj.items[i].volumeInfo[searchField] >= searchVal) {
				results.push(myObj.items[i].volumeInfo.averageRating)
			}
			
		}
		var x = "";
		for (i in results) {
			x += results[i]+"<br>";
		}

		
    }

};


function calljson(calls,stridx){
request.open("GET", "https://www.googleapis.com/books/v1/volumes?q=inauthor:"+<?php echo "'".$regValue."'" ?>+"+&maxResults="+calls+"&startIndex="+stridx, true); //&maxResults=40&startIndex=100
request.send();

}
</script>

</body>
</html>