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
  <form id="mainSearchForm" action="index.php">
    <input name="maxResults" type="hidden" value="6">
    <input name="searchTerm" type="text" value="">
    <input type="submit" value="Search">
	
	<select name="queryType">
      <option value="all" selected="true">All Books</option>
      <option value="free-ebooks">Free e-books</option>
      <option value="full">view entire volume text</option>
	  <option value="paid-ebooks">Google ebook with a price</option>
	  <option value="partial">Full view books only</option>
    </select>
	
<!--
"ebooks" - All Google eBooks.
"free-ebooks" - Google eBook with full volume text viewability.
"full" - Public can view entire volume text.
"paid-ebooks" - Google eBook with a price.
"partial" - Public able to see parts of text.
-->
	
	<select name="queryOrderBy">
      <option value="relevance" selected="true">order by relevance</option>
      <option value="newest">order by newest</option>
      
    </select>
	
    
      <img src="http://books.google.com/googlebooks/images/poweredby.png"
      border="0" width="62" height="30" align="absbottom"
      style="position:relative; top: 6px; padding-left: 10px"></a>
  </form>
</div>

</body>
</html>
