$(function(){
  $('.show-icon').hide();

  $('.hide-icon').click(function(){
    $('.form-passcode').attr('type','text');
    $(this).hide();
    $('.show-icon').show();
  });

  $('.show-icon').click(function(){
    $('.form-passcode').attr('type','password');
    $(this).hide();
    $('.hide-icon').show();
  });

});
