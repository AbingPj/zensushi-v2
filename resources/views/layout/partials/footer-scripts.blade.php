
{{-- <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('8edc97b8507f1e75e12e', {
    cluster: 'ap1',
    forceTLS: true
  });

//   var channel = pusher.subscribe('my-channel');
//   channel.bind('my-event', function(data) {
//     alert(JSON.stringify(data));
//   });

  var channel = pusher.subscribe('ItemsChannel');
  channel.bind('ItemsEvent', function(data) {
    alert(JSON.stringify(data));
  });
</script> --}}







{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
<script>
function LoadingOverlay() {
 var customElement = $("<img>", {
     class: "ld ld-shadow",
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

</script>

{{-- <!-- Scripts --> --}}
<script src="{{ url('/js/app.js') }}"></script>