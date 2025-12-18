<div>
    <div class="form-group has-icon-left">
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
        </label>

        <div class="position-relative">
            <input
                type="{{ $type }}"
                id="{{ $name }}"
                name="{{ $name }}"
                placeholder="{{ $placeholder }}"
                class="form-control @error($name) is-invalid @enderror"

                {{-- cegah Livewire membaca min/max sebagai rule --}}
                {{ $attributes->except([
                    'min', 'max', 'step',
                    'wire:model',
                    'wire:model.live',
                    'wire:model.lazy',
                    'wire:model.blur',
                    'wire:model.debounce',
                ]) }}

                {{-- inject ulang wire:model --}}
                @if($attributes->get('wire:model'))
                    wire:model="{{ $attributes->get('wire:model') }}"
                @elseif($attributes->get('wire:model.live'))
                    wire:model.live="{{ $attributes->get('wire:model.live') }}"
                @elseif($attributes->get('wire:model.blur'))
                    wire:model.blur="{{ $attributes->get('wire:model.blur') }}"
                @elseif($attributes->get('wire:model.lazy'))
                    wire:model.lazy="{{ $attributes->get('wire:model.lazy') }}"
                @elseif($attributes->get('wire:model.debounce'))
                    wire:model.debounce="{{ $attributes->get('wire:model.debounce') }}"
                @endif
            >

            @if($icon)
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
