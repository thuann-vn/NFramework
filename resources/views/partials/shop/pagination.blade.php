@if ($paginator->hasPages())
    <div class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        @endif

        <span>{{__('pagination.page')}}</span>
        <select>
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <option value="{{ $url }}" selected>{{ $page }}</option>
                        @else
                            <option value="{{ $url }}">{{ $page }}</option>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </select>
        <span>{{__('pagination.total_page', ['total' => $paginator->lastPage()])}}</span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        @endif
    </div>
@endif
