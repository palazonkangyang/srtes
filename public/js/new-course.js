$(function() {

  $("#select-programme").change(function() {
    var id = $(this).val();

    if(id == 0)
    {
      $(".new-course").css('display', 'block');
      $(".new-date-time-programme").css('display', 'block');
      $(".date-time-programme").css('display', 'none');

      $("#provider-text").text('');
      $("#type-training-text").text('');
      $("#budget_availability_text").text('');
      $("#isfunds-text").text('');
      $('#funds-text').text('');
      $("#fee-text").text('');
    }

    else
    {
      $("#new-course-name").val('');
      $(".new-item-date").val('');
      $(".new-item-date2").val('');

      $(".new-course").css('display', 'none');
      $(".new-date-time-programme").css('display', 'none');
      $(".date-time-programme").css('display', 'block');
    }
  });

  // $("#new-course").focusout(function() {
  //
  // });

});
