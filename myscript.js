

$(document).ready(function(){	

   $("#mainSearchForm").submit(function(){
	
   	  var search = $("#books").val();
   	  if(search == "")
   	  {
   	  	alert("Παρακαλώ εισάγετε στοιχεία αναζήτησης");
   	  }
   	  else{		
   	
	  $( "#result" ).empty();
	  

   	   $.get("https://www.googleapis.com/books/v1/volumes?maxResults=40&key=AIzaSyDHJ5YMq6EhyHx2urd2bcFMuPGu8-pA6aY&q=" +search,function(response){
   
      

          for(i=0;i<response.items.length;i++)
          {
		   title=$('<h6> Τίτλος:'+ response.items[i].volumeInfo.title + '</h6>');  
           author=$('<h6> Συγγραφέας:' + response.items[i].volumeInfo.authors + '</h6>');
		   publisher=$('<h6> Εκδοτικός οίκος:' + response.items[i].volumeInfo.publisher +'</h6>');
		   year=$('<h6> Χρονολογία έκδοσης:' + response.items[i].volumeInfo.publishedDate +'</h6>');
           img = $('<img id="dynamic"><br><a target="_blank" href=' + response.items[i].volumeInfo.infoLink + '><button id="infobutton" >περισσότερες πληροφορίες εδώ</button></a><br>'); 	
		   add = $('<button id="infobutton" style="background-color:red">προσθήκη στα αγαπημένα</button>'); 	
		   //text = $('<h6> Κείμενο:'+ response.items[i].searchInfo.textSnippet + '"<a href="' + response.items[i].accessInfo.webReaderLink + '" target="_blank"> Read more</a></p></h6>');
		   text=$('<h6 style="color:red;"> Περιγραφή:' + response.items[i].searchInfo.textSnippet +'</h6>');
		   
           url= response.items[i].volumeInfo.imageLinks.thumbnail;
		   
           img.attr('src', url);
		   title.appendTo('#result');
           author.appendTo('#result');
		   publisher.appendTo('#result');
		   year.appendTo('#result');
           img.appendTo('#result');
		   add.appendTo('#result');
		   text.appendTo('#result');
		  
          }
   	  });
      
      }
      return false;

   });

});
