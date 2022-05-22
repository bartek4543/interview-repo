@if($errors->any())
    <div class="error">
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    </div>
@endif
@isset($exception)
    <div class="error">
        123234 {{ $exception->getMessage() }}
    </div>
@endif
