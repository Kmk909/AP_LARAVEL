@extends ('layout')

@section('content')
  <div class="container">
    <div>
    
      <a href="posts/create" class="btn btn-success">New Post</a>
      <a href="logout" class="btn btn-danger">Log Out</a>
      <h4 style="float:right">{{Auth::user()->name}}</h4>
    </div><br/>
    @if (session('status'))
    <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!{{ session('status') }}</strong> 
    </div>
    @endif
   <div class="card">
    <h5 class="card-header" style="text-align:center">Contents</h5>
    <div class="card-body">
        @foreach($data as $post)
        <div>
        <h5 class="card-title">{{$post->name}}</h5>
        <p class="card-text">{{$post->description}}</p>
        <div class="form-row">
        <a style="height:38px; margin-right:3px" href="\posts\{{$post->id}}" class="btn btn-primary">View</a>
        <a style="height:38px; margin-right:3px" href="\posts\{{$post->id}}\edit" class="btn btn-warning">Edit</a>
        <form action="\posts\{{$post->id}}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">Delete</button>

        </form>
        </div>
        </div><br/>
        @endforeach
    
    </div>
   </div>
  </div>
    
@endsection