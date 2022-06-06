@extends ('layout')

@section('content')
  <style>
    .form-error{
      border:1px solid red;
    }
  </style>
  <div class="container">
    
   <div class="card">
    <h5 class="card-header" style="text-align:center">New Post</h5>
    <div class="card-body">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="\posts" method="post">
        @csrf
   <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control {{$errors->first('name') ? 'form-error':''}}" name="name" value="{{ old('name') }}" placeholder="Enter name" >
    
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Description</label>
    <textarea class="form-control" name="description" value="{{ old('description') }}" placeholder="Enter Description"></textarea>
    
    </div>
    <div class="form-group">
    <select name="category_id" id="" class="form-control">
      <option value="">Select Category</option>
      @foreach($categories as $cat)
        <option value="{{$cat->id}}">{{$cat->name}}</option>
      @endforeach
    </select>

    </div>
    

   <button type="submit" class="btn btn-primary">Submit</button>
   <a href="\posts" class="btn btn-success">Back</a>
   </form>
    
    </div>
   </div>
  </div>
    
@endsection