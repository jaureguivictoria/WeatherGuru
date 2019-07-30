<title>Weather Guru</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>

<!-- Scripts -->
<script defer src="{{ mix('/js/app.js') }}"></script>
<script defer src="{{ url('/js/jquery.validate.min.js') }}"></script>

@yield('scripts')

<!-- Styles -->
<link rel="stylesheet" href="{{ mix('/css/app.css') }}">

<!-- Google Verification -->
<meta name="google-site-verification" content="T_gFU8G40n1NoQxeqVh4riwE6ktKwHEv-4GpNruIYrY" />

@yield('styles')