<!-- Pagination Styles -->
<style>
.pagination-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.pagination-mobile {
    display: flex;
    justify-content: space-between;
    flex: 1;
}

.pagination-desktop {
    display: none;
}

.pagination-btn {
    position: relative;
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.25;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    background-color: #ffffff;
    color: #374151;
    text-decoration: none;
    transition: all 0.15s ease-in-out;
}

.pagination-btn:hover {
    color: #6b7280;
}

.pagination-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.5);
    border-color: #3b82f6;
}

.pagination-btn:active {
    background-color: #f3f4f6;
    color: #374151;
}

.pagination-btn-disabled {
    color: #6b7280;
    cursor: default;
    background-color: #ffffff;
    border: 1px solid #d1d5db;
}

.pagination-btn-next {
    margin-left: 12px;
}

.pagination-info {
    padding-left: 8px;
    font-size: 14px;
    color: #374151;
    line-height: 1.25;
}

.pagination-info-highlight {
    font-weight: 500;
}

.pagination-numbers {
    position: relative;
    z-index: 0;
    display: inline-flex;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    border-radius: 6px;
}

.pagination-numbers.rtl {
    flex-direction: row-reverse;
}

.pagination-arrow {
    position: relative;
    display: inline-flex;
    align-items: center;
    padding: 8px;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.25;
    border: 1px solid #d1d5db;
    background-color: #ffffff;
    color: #6b7280;
    text-decoration: none;
    transition: all 0.15s ease-in-out;
}

.pagination-arrow-left {
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
}

.pagination-arrow-right {
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px;
    margin-left: -1px;
}

.pagination-arrow:hover {
    color: #9ca3af;
}

.pagination-arrow:focus {
    z-index: 10;
    outline: none;
    box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.5);
    border-color: #3b82f6;
}

.pagination-arrow:active {
    background-color: #f3f4f6;
    color: #6b7280;
}

.pagination-arrow-disabled {
    cursor: default;
    color: #6b7280;
    background-color: #ffffff;
}

.pagination-page {
    position: relative;
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    margin-left: -1px;
    font-size: 14px;
    height: 38px;
    font-weight: 500;
    line-height: 1.25;
    border: 1px solid #d1d5db;
    background-color: #ffffff;
    color: #374151;
    text-decoration: none;
    transition: all 0.15s ease-in-out;
}

.pagination-page:hover {
    color: #6b7280;
}

.pagination-page:focus {
    z-index: 10;
    outline: none;
    box-shadow: 0 0 0 3px rgba(156, 163, 175, 0.5);
    border-color: #3b82f6;
}

.pagination-page:active {
    background-color: #f3f4f6;
    color: #374151;
}

.pagination-page-current {
    cursor: default;
    color: #6b7280;
    background-color: #ffffff;
    border: 1px solid #d1d5db;
}

.pagination-separator {
    cursor: default;
    color: #374151;
    background-color: #ffffff;
    border: 1px solid #d1d5db;
}

.pagination-icon {
    width: 20px;
    height: 20px;
    fill: currentColor;
}

/* Dark mode styles */
.dark .pagination-btn {
    color: #d1d5db;
    background-color: #1f2937;
    border-color: #4b5563;
}

.dark .pagination-btn:focus {
    border-color: #1d4ed8;
}

.dark .pagination-btn:active {
    background-color: #374151;
    color: #d1d5db;
}

.dark .pagination-btn-disabled {
    color: #4b5563;
    background-color: #1f2937;
    border-color: #4b5563;
}

.dark .pagination-info {
    color: #9ca3af;
}

.dark .pagination-arrow {
    background-color: #1f2937;
    border-color: #4b5563;
}

.dark .pagination-arrow:active {
    background-color: #374151;
}

.dark .pagination-arrow:focus {
    border-color: #1e40af;
}

.dark .pagination-arrow-disabled {
    background-color: #1f2937;
    border-color: #4b5563;
}

.dark .pagination-page {
    color: #9ca3af;
    background-color: #1f2937;
    border-color: #4b5563;
}

.dark .pagination-page:hover {
    color: #d1d5db;
}

.dark .pagination-page:active {
    background-color: #374151;
}

.dark .pagination-page:focus {
    border-color: #1e40af;
}

.dark .pagination-page-current {
    background-color: #1f2937;
    border-color: #4b5563;
}

.dark .pagination-separator {
    background-color: #1f2937;
    border-color: #4b5563;
}

/* Responsive design */
@media (min-width: 640px) {
    .pagination-mobile {
        display: none;
    }
    
    .pagination-desktop {
        display: flex;
        flex: 1;
        align-items: center;
        justify-content: space-between;
    }
}
</style>

<!-- Pagination HTML -->
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="pagination-nav">
        <div class="pagination-mobile">
            @if ($paginator->onFirstPage())
                <span class="pagination-btn pagination-btn-disabled">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="pagination-btn">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="pagination-btn pagination-btn-next">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="pagination-btn pagination-btn-disabled pagination-btn-next">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="pagination-desktop">
            <div>
                <p class="pagination-info">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="pagination-info-highlight">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="pagination-info-highlight">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="pagination-info-highlight">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="pagination-numbers rtl">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="pagination-arrow pagination-arrow-left pagination-arrow-disabled" aria-hidden="true">
                                <svg class="pagination-icon" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-arrow pagination-arrow-left" aria-label="{{ __('pagination.previous') }}">
                            <svg class="pagination-icon" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="pagination-page pagination-separator">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="pagination-page pagination-page-current">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="pagination-page" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-arrow pagination-arrow-right" aria-label="{{ __('pagination.next') }}">
                            <svg class="pagination-icon" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="pagination-arrow pagination-arrow-right pagination-arrow-disabled" aria-hidden="true">
                                <svg class="pagination-icon" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif