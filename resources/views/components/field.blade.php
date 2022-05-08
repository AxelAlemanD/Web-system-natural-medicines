<div class="form-group">
    <label class="form-label" for="{{ $name }}">{{$label}}:</label>
    <input class="form-control @error("$name") is-invalid @enderror" placeholder="{{ $placeholder }}" name="{{ $name }}" type="{{ $type }}" value='{{ $value }}' {{$events}} required>
    @error("$name")
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>