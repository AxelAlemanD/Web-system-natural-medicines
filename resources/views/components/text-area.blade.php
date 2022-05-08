<div class="form-group">
    <label class="form-label" for="{{ $name }}">{{$label}}:</label>
    <textarea class="form-control @error('{{ $name }}') is-invalid @enderror" name="{{ $name }}" placeholder="{{ $placeholder }}" maxlength="250" rows="{{$rows}}" {{$other}}>{{ $content }}</textarea>
    @error('{{ $name }}')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>