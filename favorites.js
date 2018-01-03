$(document).ready(function() {
  $("tr").click(function(){
    url = document.getElementsByName('url')[0].value;
    window.open(url, '_blank');  })

});
