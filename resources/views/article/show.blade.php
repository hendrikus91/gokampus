@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td width="20%">Title</td>
                                <td>{{ $article->title }}</td>
                            </tr>

                            <tr>
                                <td width="20%">Creator</td>
                                <td>{{ $article->user->name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td width="20%">Content</td>
                                <td>{{ $article->content }}</td>
                            </tr>
                            <tr>
                                <td>Image</td>
                                <td><img src="{{ asset('storage/'.$article->article_image) }}" class="img img-thumbnail"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection