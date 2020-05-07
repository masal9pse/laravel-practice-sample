@if(session()->has('status'))
<div class="alert alert-success">{{ session('status') }}</div>
@endif