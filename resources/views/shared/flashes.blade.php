@if (session('success'))
<script>
     setTimeout(function() {
        UIkit.notification({
            message: '<span uk-icon=\'icon: check\'></span>&nbsp;' + "{{ session('success') }}",
            status: 'success',
            pos: 'top-center',
            timeout: 10000
        });
     }, 500);
</script>
@endif

@if (session('error'))
<script>
    UIkit.notification({
        message: '<span uk-icon=\'icon: warning\'></span>&nbsp;' + "{{ __('app.general-error') }}",
        status: 'danger',
        pos: 'top-center',
        timeout: 5000
    });
</script>
@endif


@if (session('warning'))
<script>
    UIkit.notification({
        message: '<span uk-icon=\'icon: warning\'></span>&nbsp;' + "{{ session('warning') }}",
        status: 'warning',
        pos: 'top-center',
        timeout: 50000
    });
</script>
@endif
