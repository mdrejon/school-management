{{-- Custom paginator view styled to the theme's wexnix_pagination-area markup instead of Bootstrap's default. --}}
@if ($paginator->hasPages())
    <div class="wexnix_pagination-area">
        <nav aria-label="Pagination">
            <ul class="pagination">
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link" aria-label="Previous"><span aria-hidden="true"><i class="fas fa-arrow-left"></i></span></span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous"><span aria-hidden="true"><i class="fas fa-arrow-left"></i></span></a>
                    </li>
                @endif

                @for ($page = 1; $page <= $paginator->lastPage(); $page++)
                    <li class="page-item {{ $page === $paginator->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                    </li>
                @endfor

                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next"><span aria-hidden="true"><i class="fas fa-arrow-right"></i></span></a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" aria-label="Next"><span aria-hidden="true"><i class="fas fa-arrow-right"></i></span></span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
