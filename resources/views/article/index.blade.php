@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <a href="{{ route('article.create') }}" class="btn btn-success mb-2">Add Article</a>
            <div class="card">
                <div class="card-body">

                    @if($articles->isNotEmpty())
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Content</th>
                                <th>Creator</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($articles as $article)
                            <tr>
                                <td width="2%">{{ ($articles ->currentpage()-1) * $articles ->perpage() + $loop->index + 1 }}</td>
                                <td width="5%">{{ $article->title }}</td>
                                <td width="8%"><img src="{{ asset('storage/'.$article->article_image) }}" class="img img-thumbnail img-responsive" style="height:120px;"></td>
                                <td width="10%">{{ $article->content }}</td>
                                <td width="2%">{{ $article->user->name ?? '' }}</td>
                                <td width="3%">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="{{ route('article.edit', ['article' => $article->id]) }}" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i> </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="{{ route('article.show', ['article' => $article->id]) }}" class="btn btn-success btn-sm"> <i class="fas fa-eye"></i> </a>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="javascript:void(0)" onclick="return confirm('Are you sure you want to delete this item?');">
                                                <form action="{{ route('article.destroy', ['article' => $article->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    {!! $articles->links('pagination::bootstrap-5') !!}

                    @else
                    <div class="alert alert-danger">
                        <p class="text-center">DATA NOT FOUND</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection