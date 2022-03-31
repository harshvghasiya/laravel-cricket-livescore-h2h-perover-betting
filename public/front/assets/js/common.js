$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$('form.FromSubmit').submit(function (event) {
    var formId = $(this).attr('id');
    // return false;
     // alert('dfg');
        var formAction = $(this).attr('action');
      // if ($('#'+formId).valid()) {
        var buttonText = $('#'+formId+' button[type="submit"]').text();
        var $btn = $('#'+formId+' button[type="submit"]').attr('disabled','disabled').html("Loading...");
        var redirectURL = $(this).data("redirect_url");
        $.ajax({
            type: "POST",
            url: formAction,
            data: new FormData(this),
            contentType: false,
            processData: false,
            enctype: 'multipart/form-data',
            success: function (response) {
                if (response.status == 1 && response.msg !="") {
                    $('#'+formId+' button[type="submit"]').text(buttonText);
                    $('#'+formId+' button[type="submit"]').removeAttr('disabled','disabled');
                    window.location=response.url;
                }
                else{
                    if (response.url != null) {
                         $('#'+formId+' button[type="submit"]').text(buttonText);
                         $('#'+formId+' button[type="submit"]').removeAttr('disabled','disabled');
                        window.location=response.url;
                    }
                    $('#'+formId+' button[type="submit"]').text(buttonText);
                         $('#'+formId+' button[type="submit"]').removeAttr('disabled','disabled');
                }
            },
            error: function (jqXhr) {

                var errors = $.parseJSON(jqXhr.responseText);
                showErrorMessages(formId, errors);
                $('#'+formId+' button[type="submit"]').text(buttonText);
                $('#'+formId+' button[type="submit"]').removeAttr('disabled','disabled');
            }
        });
        return false;
    // };

    
});
function showErrorMessages(formId, errorResponse) {
    var msgs = "";
    $.each(errorResponse.errors, function(key, value) {
        msgs += value + " <br>";
    $("#"+key).html(value);
    

    });
    // flashMessage('danger', msgs,formId);
}
function flashMessage($type, message,formId) {
        
    $("#"+formId+'1').html(message);
    // $.bootstrapGrowl(message, {
    //     ele:'body',
    //     type: $type,
    //     delay: 5000,
    //     offset: {from: 'top'}, // 'top', or 'bottom'

    // });
}