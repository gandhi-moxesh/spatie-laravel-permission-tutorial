@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (isset($posts)) 
                            @role('writer|admin')
                                <a class="nav-link" href="/addPostsForm">Add posts</a><br>
                            @endrole
                            <table width="100%" border="1">
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    @can('edit post')
                                        <th>Edit</th>
                                    @endcan
                                    @role('publisher|admin')
                                        <th>Delete</th>
                                    @endrole                                        
                                </tr>                            
                                @foreach($posts AS $post) 
                                    <tr>
                                        <th>{{$post->id}}</th>
                                        <th>{{$post->title}}</th>
                                        <th>{{$post->body}}</th>
                                        @can('edit post')
                                            <th><a class="nav-link" href="/editPostsForm/{{$post->id}}">Edit</a></th>
                                        @endcan
                                        @role('publisher|admin')
                                            <th><a class="nav-link" href="/deletePosts/{{$post->id}}">Delete</a></th>
                                        @endrole
                                    </tr> 
                                @endforeach
                            </table>
                    @endif
                    @if(isset($addPosts))
                        <form method="POST" action="addPosts">
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title :</label>
                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" required autofocus>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right">Body : </label>
                                <div class="col-md-6">
                                    <textarea id="body" class="form-control" name="body" required autofocus></textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary"> Submit </button>
                                </div>
                            </div>
                        </form>
                    @endif
                    @if(isset($editPosts))
                        <form method="POST" action="{{ route('editPosts') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title :</label>
                                <div class="col-md-6">
                                    <input value="{{ $editPosts[0]->title }}" id="title" type="text" class="form-control" name="title" required autofocus>
                                </div>
                            </div>
                            <input value="{{ $editPosts[0]->id }}" id="id" type="hidden" class="form-control" name="id" >
                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right">Body : </label>
                                <div class="col-md-6">
                                    <textarea id="body" class="form-control" name="body" required autofocus>{{ $editPosts[0]->body }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary"> Submit </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
