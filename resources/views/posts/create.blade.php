@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="max-w-3xl mx-auto">
    <h1 class="text-4xl font-bold text-gray-800 mb-8">✍️ Create New Post</h1>

    <div class="bg-white rounded-lg shadow-md p-8">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}" 
                       class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror" 
                       placeholder="Enter post title"
                       required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Body</label>
                <textarea name="body" 
                          rows="12" 
                          class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('body') border-red-500 @enderror" 
                          placeholder="Write your post content here..."
                          required>{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-medium">
                    📤 Publish Post
                </button>
                <a href="{{ route('posts.index') }}" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-400 font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection