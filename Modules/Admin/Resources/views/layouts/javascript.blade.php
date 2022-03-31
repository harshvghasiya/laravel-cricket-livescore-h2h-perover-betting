<script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/jquery.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--app JS-->
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/app.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/common.js"></script>
     <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/sweet-alert/sweetalert.min.js"></script>
    <script src="{{UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/toaster/toastr.min.js"></script>
<script src="{{ UPLOAD_AND_DOWNLOAD_URL()}}/admin/assets/js/tinymce/tinymce.min.js"></script>


<script type="text/javascript">
    $(document).on("click","#select_all",function(){
    check_uncheck_data();
});

function check_uncheck_data(){
  if($("#select_all").prop("checked")){
    $(".select_checkbox_value").prop("checked",true);
  }else{
    $(".select_checkbox_value").prop("checked",false);
  }
}


$(document).ready(function() {
    $('.search-control').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
          var search_val=$(this).val();
          {{-- window.location={{route()}} --}}
          
        }
        
      });

    $(document).on('click', '.notifications', function(event) {
        event.preventDefault();
        $.ajax({
            url: '{{route('admin.panel_activity.status_all')}}',
            type: 'POST',
            success:function(response) {
                $('.not_co').text('0');
                window.location.reload();
            }
        });
        
    });
});

$(document).ready(function() {
    $(document).on('click', '.support_see', function(event) {
        event.preventDefault();
        $.ajax({
            url: '{{route('admin.support.mark_all_as_read')}}',
            type: 'POST',
            success:function(response) {
                $('.support_count').text('0');
                window.location.reload();
            }
        });
        
    });
});
tinymce.init({
        selector : '.editor-tinymce',
        height: 250,
        directionality : "ltr",
        plugins : 'advlist autolink lists link charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table contextmenu paste code image codesample',
        toolbar : 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image codesample',

        automatic_uploads : false,
        relative_urls : false,

       
    });
</script>
    <!-- login js-->
    <!-- Plugin used-->