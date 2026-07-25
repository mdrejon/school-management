<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Loaded directly into Vvveb's iframe via a real navigation (iframe.src = url),
         linking the actual frontend theme stylesheets so editing happens against
         the site's real look, the same fonts/colors/spacing visitors see. --}}
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/all-fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <style>body { padding: 24px; }</style>
</head>
<body>
{!! $bodyHtml !!}
</body>
</html>
