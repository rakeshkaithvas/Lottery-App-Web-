<button type="button" style="padding: 0; border: none; background: none;" data-bs-toggle="modal"
    data-bs-target="#addModel_{{ $id }}">
    <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-transparent rounded-pill" data-bs-toggle="tooltip"
        title="{{ $title }}" data-bs-custom-class="tooltip-primary">
        @if (empty($icon))
            <i class="ri-add-line"></i>
        @else
            <i class="{{ $icon }}"></i>
        @endif
    </a></button>
