{{-- If any error message --}}
@if (session('errors'))
    <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="flex-shrink-0 me-2 svg-warning" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
            height="1.5rem" viewBox="0 0 24 24" width="1.5rem" fill="#000000">
            <g>
                <rect fill="none" height="24" width="24"></rect>
            </g>
            <g>
                <g>
                    <g>
                        <path d="M12,5.99L19.53,19H4.47L12,5.99 M12,2L1,21h22L12,2L12,2z"></path>
                        <polygon points="13,16 11,16 11,18 13,18"></polygon>
                        <polygon points="13,10 11,10 11,15 13,15"></polygon>
                    </g>
                </g>
            </g>
        </svg>
        <div>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach

        </div>
    </div>
@endif
