<script type="text/javascript">

    // toast for laravel validation error
    @if ($errors->any())
        let errMsg = "{{ config('custom.msg.err') }} Invalid Data";
        toastr.error(errMsg)
    @endif
    @if(Session::has('msg'))
    var type = "{{ Session::get('type') }}";

    switch(type){
        case 'info':
        break;

        case 'warning':
        toastr.warning("{{ Session::get('msg') }}");
        break;

        case 'success':
        toastr.success("{{ Session::get('msg') }}");
        break;

        case 'error':
        toastr.error("{{ Session::get('msg') }}");
        break;
    }
    @endif
</script>
