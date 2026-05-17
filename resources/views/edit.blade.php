@extends('layout')

@section('content')


    <div class="container">

        <div class="card">
        <div class="card-header" style="text-align: center;">
            Edit Post
        </div>
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

           <form action="/posts/{{$post->id}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input value="{{old('name',$post->name) }}" type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
            </div><br>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="" placeholder="Enter description">{{old('name', $post->description)}}</textarea>
            </div><br>

            <div class="form-group">
                <select name="category_id" id="" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{$cat->id}}" {{$cat->id == $post->category_id ? 'selected' : ''}}>{{$cat->name}}</option>
                    @endforeach
                </select>
            </div><br>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/posts" class="btn btn-success">Back</a>
     
           </form>
            
        </div>
        </div>
    </div>



@endsection