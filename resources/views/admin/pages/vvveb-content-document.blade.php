<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Loaded directly into Vvveb's iframe via a real navigation (iframe.src = url),
         linking the actual frontend theme stylesheets so editing happens against
         the site's real look, the same fonts/colors/spacing visitors see. --}}
    <base href="{{ asset('frontend') }}/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Yantramanav:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/all-fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <style>
        body {
            padding: 30px 15px;
            font-family: 'Roboto', 'Yantramanav', sans-serif;
            background-color: #ffffff;
            color: #212529;
        }
        .wexnix_page-builder {
            min-height: 250px;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
{{-- Mirrors frontend.pages.show's exact wrapper
     (.wexnix_page-builder.py-120 > .container) around the same content —
     without it, any CSS selector Vvveb's style panel writes based on the
     live DOM position (e.g. "body > p") is captured relative to THIS
     iframe's shallower tree and then simply doesn't match once the same
     content is rendered inside that wrapper on the real page.

     The marker is a data-attribute, deliberately NOT an id:
     Vvveb.Builder.getSelectorForElement() (builder.js) stops walking up
     the ancestor chain the moment it hits an element with an id and uses
     "#that-id" as the anchor — so an id here would get baked into every
     selector the admin generates for anything inside (e.g. "#marker > p")
     referencing an element that only exists in this editing iframe and
     never in production, which is worse than the mismatch this is meant
     to fix. A plain data-attribute is invisible to that selector logic
     (only .id and .classList are special-cased) while still being exactly
     what PageVisualBuilderController's extractSavableContent() looks for
     to strip these two wrapper divs back out before saving — they're
     supplied by pages/show.blade.php itself in production, so they must
     never become part of the stored content or the page would end up
     double-wrapped. --}}
<div class="wexnix_page-builder py-120">
    <div class="container" data-page-content-root="1">
{!! $bodyHtml !!}
    </div>
</div>
</body>
</html>
