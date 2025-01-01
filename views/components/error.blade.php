@if ($errors->any())
<div class="error-messages">
    @foreach ($errors->all() as $error)
        <div class="invalid-feedback">{{ $error }}</div>
    @endforeach
</div>
@endif