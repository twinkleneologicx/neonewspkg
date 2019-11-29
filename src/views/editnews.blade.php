@extends('news::layout.app')
@section('content')
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-datetimepicker.min.css')}}">
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    {{-- {{dd($news)}} --}}
    <div class="row" style="overflow-x:hidden; margin:0; margin-top:3%;">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="card" style="background-color: #45a3d6;">
                <div class="card-body" style="color:#fff;">
                  <h4 class="card-title">Edit News</h4>
                  
                  <form action="{{route('news.update', ['news'=>$news->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="category">Category:</label>
                      <select name="cat_id" class="form-control" id="cat_id">
                        <option>Choose Category</option>
                        @foreach ($cat as $cats)
          
                        <option value="{{$cats->id}}">{{$cats->name}}</option>
                        @endforeach
          
          
                      </select>
          
                    </div>
                    <div class="form-group">
                      <label for="image">Image:</label>
                      <img src="{{\Storage::url($news->image)}}" alt="" width="150px" height="100px">
                      <input type="file" class="form-control" id="image" name="image" style="padding: 3px; margin-top:5px;">
                    </div>
                    <div class="alert alert-danger">Note* 
                      <ul>
                        <li>The size of image should be less than 2MB.</li>
                        <li>The ideal maximum dimensions of image are 365 x 274px.</li>
                        <li>File type should be jpeg,jpg,png, and gif.</li>
                      </ul>
                    </div>
                    <div class="form-group">
                        <label for="heading">Heading:</label>
                    <input type="text" class="form-control" name="heading" id="heading" value="{{$news->heading}}">
                    <input type="checkbox" name="is_newsticker" id="is_newsticker" @if($news->is_newsticker) checked @endif> <span>Show this news in ticker</span>
                    </div>
                    <div class="form-group">
                      <label for="newwv">Date:</label>
                    <input type='text' class="form-control" id='news_date' name="news_date" value="{{$news->news_date}}" />
                  </div>
                    <div class="form-group">
                        <textarea name="description" id="description" class="form-control" cols="30" rows="5">{!! $news->description !!}</textarea>
                    </div>
                    <div>
                      <button type="submit" class="btn"
                        style="background: #FF8F8C; border: 1px solid #FF8F8C;color: #fff; float: right; font-weight:500;">Update</button>
                    </div>
                  </form>
                </div>
              </div>
          
            </div>
            <div class="col-md-3"></div>
          </div>
          
          <script>
            $(function(){
                        var cat = {{$news->ncat_id}};
                        $('#cat_id').val(cat);
                    })
          </script>
          <script>
                CKEDITOR.replace( 'description' );
            </script>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
        <script src="{{URL::asset('js/datetimepicker.js')}}"></script>
        <script type="text/javascript">
            $(function () {
               
                $('#news_date').click(function(){ 
                    $(this).datetimepicker().datetimepicker('show') ;
                });
             });
        </script>
@endsection