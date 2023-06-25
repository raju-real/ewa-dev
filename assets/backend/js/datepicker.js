$(function() {
  'use strict';

  if($('.date-picker').length) {
    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('.date-picker').datepicker({
      format: "mm/dd/yyyy",
      todayHighlight: true,
      autoclose: true
    });
    $('.date-picker').datepicker('setDate', today);
  }
});
