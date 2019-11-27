@extends('news::layout.app')
@section('content')
{{-- {{dd($newsCategory->name)}} --}}
<div class="row" style="overflow-x:hidden; margin:0; margin-top:3%;">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="card" style="background-color: #45a3d6;">
            <div class="card-body" style="color:#fff;">
              <h4 class="card-title">Edit News Category</h4>
              <form action="{{route('newsCategory.update', ['newsCategory'=>$newsCategory->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="category">Category:</label>
                      <input type="text" class="form-control" name="name" id="name" value="{{$newsCategory->name}}">
                   
                    </div>
                    <div>
                            <button type="submit" class="btn"
                              style="background: #FF8F8C; border: 1px solid #FF8F8C;color: #fff; float: right; font-weight:500;">Update</button>
                          </div>
                  </form>
            </div>
          </div>
      
        </div>
        <div class="col-md-4"></div>
      </div>
@endsection