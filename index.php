<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Book library</title>
<link href="layout.css" rel="stylesheet" type="text/css" />
  
</head>

<body>


<?php include 'header.php';
 include 'footer.php';
 include 'menu.php';?>


<div id="mainSearchBox">
  <h2>Αναζήτηση Βιβλίων:</h2>
  
	 
	 	<form id="mainSearchForm">
				<input type="search" id="books" placeholder="αναζήτηση βιβλίων">
				<button class="btn btn-primary btn-md" type="submit">Αναζήτηση</i></button>
<!--...
	<select name="queryType">
      <option value="all" selected="true">All Books</option>
      <option value="free-ebooks" >Free e-books</option>
      <option value="full">view entire volume text</option>
	  <option value="paid-ebooks">Google ebook with a price</option>
	  <option value="partial">Full view books only</option>
    </select>
--> 
	<select name="queryOrderBy">
	<option value="author">order by author</option>
		<option value="relevance">order by title</option>
      <option value="relevance">order by relevance</option>
      <option value="newest">order by newest</option>  
    </select>
  		
	    <img src="http://books.google.com/googlebooks/images/poweredby.png"
      border="0" width="62" height="30" align="absbottom"
      style="position:relative; top: 6px; padding-left: 10px"></a>
	  
	  
  </form>

</div>

  <div id="result">
  
  </div>
</div>
		 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script type="text/javascript" src="myscript.js"></script>
<script type="text/javascript" src="ins_basket.js"></script>

	
</body>
</html>
