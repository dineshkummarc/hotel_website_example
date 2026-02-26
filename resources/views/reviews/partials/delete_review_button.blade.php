<link rel="stylesheet" href="{{ asset('css/components/forms.css') }}">

@if(auth()->id() === $review->user_id)
    <div class="form-wrapper delete-form">
        <form action="{{ route('delete.review', $review->id) }}" method="POST" class="form delete-review-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">Delete</button>
        </form>
    </div>
@endif