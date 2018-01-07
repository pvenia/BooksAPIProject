

$(document).ready(function(){

   $("#mainSearchForm").submit(function(){
   	  var search = $("#books").val();
   	  if(search == ""){
   	  	alert("Παρακαλώ εισάγετε στοιχεία αναζήτησης");
   	  }
   	  else{
	      $( "#result" ).empty();
		  
		$.get("https://www.googleapis.com/books/v1/volumes?maxResults=40&key=AIzaSyDHJ5YMq6EhyHx2urd2bcFMuPGu8-pA6aY&q=" +search,function(response){
          for(i=0;i<response.items.length;i++){
			id=$('<div style="display:none;" id="id_' + i +'">'+ response.items[i].id + '</div>');
  		    title=$('<h6 id="title_' + i +'">Τίτλος:'+ response.items[i].volumeInfo.title + '</h6>');
            //Afti einai i grammi gia to hyperlink tis selidas statistikon me vasi to onoma toy siggrafea
			author=$('<h6 id="author_' + i +'">Συγγραφέας:' + '<a target="_blank" href="statistics.php?name='+response.items[i].volumeInfo.authors +'">' + response.items[i].volumeInfo.authors + '</a></h6>');		 	 
			publisher=$('<h6 id="publisher_' + i +'">Εκδοτικός οίκος:' + response.items[i].volumeInfo.publisher +'</h6>');
  		    year=$('<h6 id="year_' + i +'">Χρονολογία έκδοσης:' + response.items[i].volumeInfo.publishedDate +'</h6>');
			text=$('<h6 style="color:red;"> Περιγραφή:' + response.items[i].searchInfo.textSnippet +'</h6>');
            img = $('<img id="dynamic"><br><a href=' + response.items[i].volumeInfo.infoLink + '><button class="btn btn-primary btn-md" id="infobutton" >περισσότερες πληροφορίες εδώ</button></a><br>');
  		    add = $('<button type="button" class="btn btn-primary btn-md d-block m-x-auto" name="favebutton" id="'+ i +'" >προσθήκη στα αγαπημένα</button>');
			 
            url= response.items[i].volumeInfo.imageLinks.thumbnail;
            img.attr('src', url);
            id.appendTo('#result');
  		      title.appendTo('#result');
            author.appendTo('#result');
  		      publisher.appendTo('#result');
  		      year.appendTo('#result');
			   text.appendTo('#result');
            img.appendTo('#result');
  		      add.appendTo('#result');
			  
            }
     	  });
      }
      return false;

   });
});
   $('#result').on('click', 'button', function(){
    // console.log($( "#result" ).text());
    button = this.name;
    if(button=="favebutton") {
      button_id = this.id;
      id = document.getElementById("id_" + button_id).firstChild.data;
      title = (document.getElementById("title_" + button_id).firstChild.data).substring(7,);
      author = (document.getElementById("author_" + button_id).firstChild.data).substring(11,);
      publisher = (document.getElementById("publisher_" + button_id).firstChild.data).substring(16,);
      year = (document.getElementById("year_" + button_id).firstChild.data).substring(19,);
      data = {id: id, title:title, author:author, publisher:publisher, year:year};


      // console.log(title);
      // console.log(id + button + author + publisher + year);
      insert_book(data);
    }
   });

   function insert_book(data) {

     $.ajax({
       url:"insert_favorites.php", //the page containing php script
       type: "POST", //request type
       dataType: 'html',
       data: {func: 'add_favorite', data: data},
       cache: false,
	     success:function(result){
         if(result.trim().length!=0)
          alert(result);
      
       }
     });


   }
