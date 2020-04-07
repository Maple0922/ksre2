$(function(){
  $('#update').click(function(){
    $('.confirm').fadeIn(100);
    $('#update-button').fadeIn(100);
  });

  $('#delete').click(function(){
    $('.confirm').fadeIn(100);
    $('#delete-button').fadeIn(100);
  });

  $('#close-button').click(function(){
    $('.confirm').fadeOut(100);
    $('#update-button').fadeOut(100);
    $('#delete-button').fadeOut(100);
  });

  $('#manage').click(function(){
    $('.confirm').fadeIn(100);
  });
});
