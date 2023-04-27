@foreach ($flats as $flat)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $flat->name }}</h5>
            <p class="card-text">{{ $flat->description }}</p>
            <form action="{{ route('ratings.store', ['flat_id' => $flat->id, 'rating' => '']) }}" method="post">
                @csrf
                <label for="rating">Rate this flat:</label>
                <select name="rating" id="rating" required>
                    <option value="">Select a rating</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endforeach
