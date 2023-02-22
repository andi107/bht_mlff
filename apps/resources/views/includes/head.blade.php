<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>GNSS</title>

<link rel="stylesheet" href="{{ asset('global/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('global/css/bootstrap-extend.min.css')}}">
<link rel="stylesheet" href="{{ asset('global/vendor/animsition/animsition.css')}}">
<link rel="stylesheet" href="{{ asset('global/vendor/asscrollable/asScrollable.css')}}">
<link rel="stylesheet" href="{{ asset('global/vendor/switchery/switchery.css')}}">
<link rel="stylesheet" href="{{ asset('global/vendor/slidepanel/slidePanel.css')}}">
<link rel="stylesheet" href="{{ asset('global/vendor/flag-icon-css/flag-icon.css')}}">
<link rel="stylesheet" href="{{ asset('global/fonts/web-icons/web-icons.min.css')}}">
<link rel="stylesheet" href="{{ asset('global/fonts/brand-icons/brand-icons.min.css')}}">
<link rel="stylesheet" href="{{ asset('global/site.css')}}">
<link rel="stylesheet" href="{{ asset('global/fonts/material-design/material-design.min.css')}}">
<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
<link rel="stylesheet" href="{{ asset('global/vendor/toastr/toastr.css')}}">
<link rel="stylesheet" href="{{ asset('global/fonts/ionicons/ionicons.min.css')}}">
<link rel="stylesheet" href="{{ asset('global/fonts/mfglabs/mfglabs.min.css')}}">
{{-- <link rel="stylesheet" href="{{ asset('assets/examples/css/advanced/toastr.css')}}"> --}}
<script src="{{ asset('global/vendor/breakpoints/breakpoints.js')}}"></script>
<script>
    Breakpoints();
</script>

@vite([
    'resources/css/app.css',
    'resources/js/app.js',
    'resources/js/sio/socket.io.min.js',
])
<link href="{{ asset('assets/skins/blue.min.css')}}" rel="stylesheet" type="text/css">