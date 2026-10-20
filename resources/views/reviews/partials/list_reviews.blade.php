<h3 class="title2">Reviews</h3>

<div class="container-cards">
    @foreach($reviews as $review)
    <div class="card">
        <h4 class="card-title"><strong>{{ $review->user->name }}</strong> reviewed {{ $review->room->name }}</h4>
        <p class="card-text">Rating: <strong>{{ $review->rating }}</strong></p>
        <p class="card-text2">"<strong>{{ $review->comment }}</strong>"</p>

        @include('reviews.partials.delete_review_button', [
        'review' => $review,
        'btnClass' => 'btn-delete'
        ])
    </div>
    @endforeach
</div>