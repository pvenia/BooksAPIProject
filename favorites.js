
$(document).ready(function() {
  $("tr").click(function(){
    id = parseInt(this.id);
    url = document.getElementsByName('url')[id].value;
    window.open(url, '_blank');  })

});