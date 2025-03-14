<div class="form-group">
    <label for="{{ $label }}">
        {{ ucfirst($label) }}
        @if ($error)
            <span class="text-danger">required*</span>
        @endif
    </label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="form-control {{ $error ? 'is-invalid' : '' }}" placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}">

    @if ($error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endif
</div>
