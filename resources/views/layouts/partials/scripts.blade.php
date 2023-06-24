<script type="text/javascript" src="{{ asset('bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/popper.js/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}">
</script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('bower_components/modernizr/js/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/modernizr/js/css-scrollbars.js') }}"></script>
<!-- classie js -->
<script type="text/javascript" src="{{ asset('bower_components/classie/js/classie.js') }}"></script>
<!-- Syntax highlighter prism js -->
<script type="text/javascript" src="{{ asset('assets/pages/prism/custom-prism.js') }}"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="{{ asset('bower_components/i18next/js/i18next.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}">
</script>
<script type="text/javascript"
src="{{ asset('bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}">
</script>
<script type="text/javascript" src="{{ asset('bower_components/jquery-i18next/js/jquery-i18next.min.js') }}">
</script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('assets/js/script.js') }}"></script>

<script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
<script src="{{ asset('assets/js/demo-10.js') }}"></script>
<script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.mousewheel.min.js') }}"></script>
{{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}


{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/> --}}

{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script> --}}

{{-- canvas scripts --}}
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



{{-- date picker cdn scripts --}}
{{-- <script
src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
</script> --}}
<script src="{{ asset('assets/js/datepicker/bootstrap-datepicker.js') }}"></script>
{{-- select 2 multiple use --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>


{{-- data table start --}}
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/b-2.2.1/b-html5-2.2.1/datatables.min.js">
</script>
{{-- new --}}
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

{{-- ses --}}
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>



{{-- data tables --}}

{{-- summer note scripts --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

{{-- select 2 cdn --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        //datatables
        // $('#dataTables').DataTable();

        //select 2
        $('#select2').select2({
            width: '100%',
            placeholder: "Select an Option",
            //   allowClear : true
        });

        //summer note
        $('#summernote').summernote({
            height: 400
        });

        $("#notificationButton").click(function(event) {
            $("#show-notification").show();
            $("#notificationButton").hover(function() {
                $("#show-notification").show();

                $.ajax({
                    method: "GET",
                    url: "{{ route('seen.notification') }}",

                    success: function(result) {
                       $("#badge").html(0);
                    }
                });

            });

        });
        $("#notificationButton").hover(function() {
            $("#show-notification").hide();
        });
    });
</script>
