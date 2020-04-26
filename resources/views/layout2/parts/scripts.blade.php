
{{-- <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script> --}}
<script>
    function LoadingOverlay() {
     var customElement = $("<img>", {
        //  class: "ld ld-shadow",
         class: "ld ld-heartbeat",
         src: "{{ asset('images/svg_logo/logo2.svg') }}"
     });
     $.LoadingOverlay("show", {
         custom: customElement,
         image: "",
         imageAnimation: ""
     });
    }
    function LoadingOverlayHide() {
     $.LoadingOverlay("hide");
    }


    function notif(){
        // $.notify({
        //   // options
        //   message: 'Hello World'
        // },{
        //   // settings
        //   type: 'danger'
        // });
        $.notify({
        // options
        icon: 'glyphicon glyphicon-warning-sign',
        title: 'Bootstrap notify',
        message: 'Turning standard Bootstrap alerts into "notify" like notifications',
        url: 'https://github.com/mouse0270/bootstrap-notify',
        target: '_blank'
    },{
        // settings
        element: 'body',
        position: null,
        type: "info",
        allow_dismiss: true,
        newest_on_top: false,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 5000,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
        template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
            '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
            '<span data-notify="icon"></span> ' +
            '<span data-notify="title">{1}</span> ' +
            '<span data-notify="message">{2}</span>' +
            '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
            '</div>' +
            '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>'
    });
    }

</script>
{{-- <script src="{{ url('/js/app.js') }}"></script> --}}
{{-- <script src="{{ url('/js/moment/moment.min.js') }}"></script> --}}
<script src="{{ url('/js/admin.js') }}"></script>
<script src="{{ url('/js/bootstrap-notify.min.js') }}"></script>

