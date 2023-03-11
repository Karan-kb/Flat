<form method="POST" action="{{ $route }}">
    @csrf
    @isset($rating)
        @method('PUT')
    @endisset

    <div class="form-group">
        <label for="score">Score</label>
        <input type="number" class="form-control @error('score') is-invalid @enderror" id="score" name="score" value="{{ old('score', $rating->score ?? '') }}" required min="1" max="5">
        @error('score')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="comment">Comment</label>
        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3">{{ old('comment', $rating->comment ?? '') }}</textarea>
        @error('comment')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <input type="hidden" name="flat_id" value="{{ $flat->id }}">

    <button type="submit" class="btn btn-primary">{{ $
