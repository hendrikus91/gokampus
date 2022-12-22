@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('article.update', ['article' => $article->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $article->title) }}">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror

                            </div>
                            
                            <div class="mb-3">
                                
                                <label for="image" class="form-label">Image</label>
                                <img src="{{ asset('storage/'.$article->article_image) }}" style="height:120px;">
                                <input type="file" class="form-control @error('article_image') is-invalid @enderror" id="image" name="article_image">
                                @error('article_image')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">{{ old('content', $article->content) }}</textarea>
                                @error('content')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save Artile</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection