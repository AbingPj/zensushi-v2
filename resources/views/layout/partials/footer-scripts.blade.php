{{-- <!-- Scripts --> --}}
<script src="{{ url('/js/app.js') }}"></script>
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