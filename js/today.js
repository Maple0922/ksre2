$(function(){
  // 予約フォームの月日を今日の日付に
  var date = new Date();
  var nowMonth = date.getMonth()+1;
  var nowDate = date.getDate();

  var monthList = $(".form-month").children("option");
  var dateList = $(".form-date").find("option");

  monthList.eq(nowMonth-1).prop("selected",true);
  dateList.eq(nowDate-1).prop("selected",true);
});
