$(function(){
  $('.show-icon').hide();

  $('.hide-icon').click(function(){
    $('.form-password').attr('type','text');
    $(this).hide();
    $('.show-icon').show();
  });

  $('.show-icon').click(function(){
    $('.form-password').attr('type','password');
    $(this).hide();
    $('.hide-icon').show();
  });

});
