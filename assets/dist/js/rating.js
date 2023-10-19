$(document).ready(function(){
  /* 1. ketika li di hover maka */
  $('#stars li').on('mouseover', function(){
    var onStar = parseInt($(this).data('value'));
   
    $(this).parent().children('li.star').each(function(e){
      if (e < onStar) {
        $(this).addClass('hover');
      }
      else {
        $(this).removeClass('hover');
      }
    });
    
  }).on('mouseout', function(){
    $(this).parent().children('li.star').each(function(e){
      $(this).removeClass('hover');
    });
  });
  
  
  /* 2. Action to perform on click */
  $('#stars li').on('click', function(){

    
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('li.star');
    
    for (i = 0; i < stars.length; i++) {
      $(stars[i]).removeClass('selected');
    }
    
    for (i = 0; i < onStar; i++) {
      $(stars[i]).addClass('selected');
    }
    
    // JUST RESPONSE (Not needed)
    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
    // alert(ratingValue);
    var close = $(this).closest("ul").children(".selected").length;
    var id_produk = $(this).attr("idpnya");
    responseMessage(close,id_produk);
  });


  function responseMessage(close,id_produk){

    $(".nilai-rating[idpnya="+id_produk+"]").val(close);
  }
  
  
});