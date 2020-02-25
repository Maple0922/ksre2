$(function(){
  // 月日を今日の日付に
  var date = new Date();
  var nowMonth = date.getMonth()+1;
  var nowDate = date.getDate();

  var monthList = $(".form-month").children("option");
  var dateList = $(".form-date").children("option");

  monthList.eq(nowMonth-1).prop("selected",true);
  dateList.eq(nowDate-1).prop("selected",true);

  // 時間を16:00~18:00に
  var startTimeHourList = $(".form-starttime-hour").children("option");
  var endTimeHourList = $(".form-endtime-hour").children("option");

  startTimeHourList.eq(8).prop("selected",true);
  endTimeHourList.eq(10).prop("selected",true);
});
