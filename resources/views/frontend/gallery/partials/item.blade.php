{{-- Shared gallery item — used by the gallery page and the homepage "Gallery" teaser section. --}}
{{-- Expects: $image (App\Models\GalleryImage). Opens in the existing magnific-popup lightbox. --}}
<div class="wexnix_gallery-item">
    <div class="wexnix_gallery-img">
        <img src="{{ $image->image_url }}" alt="{{ $image->caption }}">
    </div>
    <div class="wexnix_gallery-content">
        <a class="wexnix_popup-img wexnix_gallery-link" href="{{ $image->image_url }}"><i class="fas fa-plus"></i></a>
    </div>
</div>
