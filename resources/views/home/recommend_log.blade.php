@if (session('result'))
  <div class="alert alert-success">
    {{ session('result') }}
  </div>
@endif
