@if ($paginator->hasPages())
    <nav class="d-flex justify-content-center">
        <ul class="pagination">
            {{-- Flecha Anterior --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&lt;</span></li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
                </li>
            @endif

            {{-- Números de Página --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link bg-primary text-white rounded-3">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link rounded-3" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Flecha Siguiente --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
                </li>
            @else
                <li class="page-item disabled"><span class="page-link">&gt;</span></li>
            @endif
        </ul>
    </nav>
@endif
