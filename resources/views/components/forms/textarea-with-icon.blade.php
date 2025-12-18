<div>
    <div class="form-group has-icon-left mb-3">
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
        </label>

        <div class="position-relative">
            <textarea
                id="{{ $name }}"
                rows="{{ $rows ?? 3 }}"
                placeholder="{{ $placeholder ?? '' }}"
                class="form-control @error($name) is-invalid @enderror"
                {{ $attributes }}
            ></textarea>

            {{-- Icon OPTIONAL --}}
            @if(!empty($icon))
                <div class="form-control-icon">
                    <i class="{{ $icon }}"></i>
                </div>
            @endif

            @error($name)
                <div class="d-block invalid-feedback fw-bold">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
