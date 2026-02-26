<h3 class="title2">Reviews</h3>

@foreach($reviews as $review)
    <div class="card">
        <h4 class="card-title"><strong>{{ $review->user->name }}</strong> reviewed {{ $review->room->name }}</h4>
        <p class="card-text">Rating: {{ $review->rating }}</p>
        <p class="card-text">{{ $review->comment }}</p>

        @include('reviews.partials.delete_review_button', [
            'review' => $review,
            'btnClass' => 'btn-delete'  
        ])
    </div>
@endforeach