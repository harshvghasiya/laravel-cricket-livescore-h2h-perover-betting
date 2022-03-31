$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('form.FromSubmit').submit(function (event) {

    // tinyMCE.triggerSave();
    event.preventDefault();
    var formId = $(this).attr('id');
    // if ($('#'+formId).valid()) {
        
        var formAction = $(this).attr('action');
        var buttonText = $('#'+formId+' button[type="submit"]').html();
        var $btn = $('#'+formId+' button[type="submit"]').attr('disabled','disabled').html("Loading...");
        // var redirectURL = $(this).data("redirect_url");
        $.ajax({
            type: "POST",
            url: formAction,
            data: new FormData(this),
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {
                if (response.status == true && response.msg !="") {
                   $('#'+formId+' button[type="submit"]').html(buttonText);
                    $('#'+formId+' button[type="submit"]').removeAttr('disabled','disabled');
                    window.location=response.url;
                }else{
                    window.location=response.url;
                }
            },
            error: function (jqXhr) {
              // console.log($.parseJSON(jqXhr.responseText).message);
              if ($.parseJSON(jqXhr.responseText).message != null) {
                    showErrorMessages(formId,$.parseJSON(jqXhr.responseText));
              }else{
                var errors = $.parseJSON(jqXhr.responseText);
                    showErrorMessages(formId, errors);
              }
                 $('#'+formId+' button[type="submit"]').html(buttonText);
                    $('#'+formId+' button[type="submit"]').removeAttr('disabled','disabled');
              
            }
        });
        return false;
    // };
});
  function showErrorMessages(formId, errorResponse) {
      var msgs = "";
      if (errorResponse.errors != null) {
         $.each(errorResponse.errors, function(key, value) {
          msgs += value + " <br>";
          });
         flashMessage('danger', msgs);
      }else{
        flashMessage('danger', errorResponse.message); 
      }
  }
  function flashMessage($type, message) {
     $.notify(message, {
          type: $type,
          allow_dismiss: false,
          delay: 2000,
          showProgressbar: false,
          timer: 300
      });
  }
  $(document).on("click", ".delete_record", function(){
    swal({
      title: "Are you sure want to delete this record ?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var formAction = $(this).data("route");
        $.ajax({
            type: "DELETE",
            url: formAction,
            success: function (response) {
                if(response.success == 1){
                   $('.table').DataTable().draw(false);
                  swal(response.msg, {
                    icon: "success",
                    });
                }else{
                    flashMessage('danger', response.msg);
                    swal(response.msg, {
                    icon: "warning",
                    });
                }
            },
            error: function (jqXhr) {
          }
        });
        
      } 
    });
});

function deleteAll(formName,url){
    var id = [];
    var checked = $("#" + formName + " input:checked").length;
        if (checked > 0)
        {
          $("#" + formName + " input:checked").each(function(){
               if($(this).val()!=1){
                    id.push($(this).val());
                 }
          });
          swal({
                  title: "do you really want to delete the record?",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {

                  var formAction = url;
                  $.ajax({
                      type: "DELETE",
                      url: formAction,
                      data:{checkbox:id},
                      success: function (response) {
                        if(response.success == 1){
                          $('.table').DataTable().draw(false);
                        }else{
                            flashMessage('danger', response.msg);
                        }
                      },
                      error: function (jqXhr) {
                    }
                });
              }
          });
        }
        else
        {
            swal("Select at list one record.");
        }
}

function statusAll(formName,url){
     var id = [];
    var checked = $("#" + formName + " input:checked").length;
        if (checked > 0)
        {
          $("#" + formName + " input:checked").each(function(){
              if($(this).val()!=1){
                  id.push($(this).val());
              }
          });
          swal({
                title: "Are you sure want to change status?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                    var formAction = url;
                    $.ajax({
                        type: "DELETE",
                        url: formAction,
                        data:{checkbox:id},
                        success: function (response) {
                            if(response.success == 1){
                                $('.table').DataTable().draw(false);
                            }else{
                                flashMessage('danger', response.msg);
                            }
                        },
                        error: function (jqXhr) {
                      }
                    });
                  swal("Success! status has been successfully changed!", {
                  icon: "success",
                });
              }
          });
        }
        else
        {
            swal("Select at list one record.");
        }
}


