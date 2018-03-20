
$(function() {

  $(".download").click(function() {

    if($(this).hasClass("btn-danger"))
    {
      $('.print-date').append($(this).attr('data-print-date'));
      $('.print_remark').modal('show');
    }

    else {

      var formData = {
      	_token: $('meta[name="csrf-token"]').attr('content'),
				app_id: $("input[name=app_id]").val()
      };

      $.ajax({
        type: 'POST',
        url: "/application/saveprintdate",
        data: formData,
        dataType: 'json',
        success: function(response)
        {
          if(response.result == 'success')
          {
            window.print();
          }
        },

        error: function (response) {
          console.log(response);
        }
      });
    }
  });

  $(".print_remark").on("hidden.bs.modal", function () {
    window.print();
  });

});
