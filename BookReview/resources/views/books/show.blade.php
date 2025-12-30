<!DOCTYPE html>
<html lang="en">

<head>
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h1 class="mb-2 text-2xl">{{ $book->title }}</h1>

        <div x-data="{ flash: true }">
            @if (session()->has('success'))
                <div x-show="flash"
                    class="relative mb-10 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
                    role="alert">
                    <strong class="font-bold">Success!</strong>
                    <div>{{ session('success') }}</div>

                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16"
                            @click="flash = false">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </span>
                </div>
            @endif
        </div>

        <div class="book-info">
            <div class="book-author mb-4 text-lg font-semibold">by {{ $book->author }}</div>
            <div class="book-rating flex items-center">
                <div class="mr-2 text-sm font-medium text-slate-700">
                    <x-star-rating :rating="$book->reviews_avg_rating" />
                </div>
                <span class="book-review-count text-sm text-gray-500">
                    {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                </span>
            </div>
        </div>
    </div>

    <div class="mb-4"><a href="{{ route('books.reviews.create', $book) }}" class="link">Add Review</a></div>

    <div>
        <h2 class="mb-4 text-xl font-semibold">Reviews</h2>
        <ul>
            @forelse ($book->reviews as $review)
                <li class="book-item mb-4">
                    <div>
                        <div class="mb-2 flex items-center justify-between">
                            <div class="font-semibold">
                                <x-star-rating :rating="$review->rating" />
                            </div>
                            <div class="book-review-count">
                                {{ $review->created_at->format('M j, Y') }}
                            </div>
                        </div>
                        <p class="text-gray-700">{{ $review->review }}</p>
                    </div>
                </li>
            @empty
                <li class="mb-4">
                    <div class="empty-book-item">
                        <p class="empty-text text-lg font-semibold">No reviews yet</p>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>

    <div class="flex items-center justify-center">
        <a href="{{ route('books.index') }}" class="link">
            To Books
        </a>
    </div>

@endsection
