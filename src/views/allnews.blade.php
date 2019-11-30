@extends('news::layout.app')
@section('content')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: -3px;
        bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    .statuspopup {
        font-size: 12px;
    }

    .more {
        height: 48px;
        display: block;
        overflow: hidden;
    }

    .btn_less {
        display: none;
    }

    .deletepopup {
        font-size: 12px;
    }
</style>

<div class="row" style="overflow-x:hidden; margin:0;">
    <div class="col-md-1"></div>
    <div class="col-md-11">
        <h2>News</h2>
    </div>
</div>
<div class="row" style="overflow-x:hidden; margin:0;">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="row" style="margin-bottom:20px;">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <a href="/newsCategory/create" class="btn btn-success">Manage News Category</a>
            </div>
            <div class="col-md-2">
                <a href="/news/create" class="btn btn-success">Add News</a>
            </div>
            <div class="col-md-6"></div>
        </div>
        <table class="table table-striped">
            <thead style="text-align:center;">
                <tr>
                    <th>S.no.</th>
                    <th>Category</th>
                    <th>Image/Document</th>
                    <th>Heading</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Time</th>
                    <th>Active/Deactive</th>
                    <th>Highlight</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody style="text-align:center;">
                @foreach ($data as $key=>$item)

                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$item->newsCategory->name}}</td>
                    @php
                    $file=$item->image;
                    $extension = pathinfo($file, PATHINFO_EXTENSION);
                    @endphp
                    <td>
                        @if ($extension=='pdf')
                        <a href="{{\Storage::url($item->image)}}" target="_blank">Document</a>
                        @else
                        <img class="zoomhover" src="{{\Storage::url($item->image)}}" alt=""
                            style="min-width: 50px; max-width: 50px; min-height: 50px; max-height: 50px;">
                        @endif

                    </td>
                    <td>{{$item->heading}}</td>
                    <td>
                        <div class="more">{!! $item->description !!}</div>
                        @if(strlen($item->description)>50)
                        <div style="float:right">
                            <a class="btn_more" href="#">More </a>
                            <a class="btn_less" href="#">Less </a>
                        </div>
                        @endif
                    </td>
                    <td>{{date('F d, Y', strtotime($item->news_date))}}</td>
                    <td>{{date('F d, Y', strtotime($item->end_date))}}</td>
                    <td>{{date('h:i:sa', strtotime($item->news_date))}}</td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" @if($item->is_active) checked @endif class="switchbtton"
                            data-id="{{$item->id}}">
                            <span class="slider round"></span>
                        </label>
                    </td>
                    <td><input type="radio" name="is_highlight" class="is_highlight" @if($item->is_highlight) checked
                        @endif data-id="{{$item->id}}"></td>
                    <td> <a href="/news/{{$item->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> &nbsp;
                        <a style="color:#007bff; cursor:pointer;" data-id="{{$item->id}}" class="delete"><i
                                class="fa fa-trash" aria-hidden="true"></i></a> </td>


                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="float:right;">{{$data->links()}}</div>
    </div>
    <div class="col-md-1"></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function(){
        $('.switchbtton').each(function(){
          $(this).click(function(){
            var id = $(this).attr('data-id');
            $.ajax({
                type : 'GET',
                url : '/newsstatus',
                data : {'id' : id},
                success : function(data){
                   if(data){
                    Swal.fire({
                title: data,
                type: "warning",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
                customClass: {
                    popup: 'statuspopup'
                  }
                }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                        })
                   }
                }
            });
          });
        });
    });
</script>
<script>
    $(function(){
        $('.is_highlight').each(function(){
            $(this).click(function(){
                var id = $(this).attr('data-id'); 
            $.ajax({
                type : 'GET',
                url : '/newshighlight',
                data : {'id' : id},
                success : function(data){
                   if(data){
                    Swal.fire({
                title: data,
                type: "warning",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
                customClass: {
                    popup: 'statuspopup'
                  }
               }).then((result) => {
                        if (result.value) {
                            location.reload();
                        }
                 })
              }
            }
            });
            });            
        });
    });
</script>
<script>
    $(function(){ 
        $('.btn_more').each(function(){
            $(this).click(function(e){
            $(this).parent().parent().find('.more').css({
                 'height': 'auto'
            })
            $(this).parent().find('.btn_less').toggle();
            $(this).parent().find('.btn_more').toggle();
            });
        });
        $('.btn_less').each(function(){
            $(this).click(function(e){
            $(this).parent().parent().find('.more').css({
                 'height': '48px'
            })
            $(this).parent().find('.btn_less').toggle();
            $(this).parent().find('.btn_more').toggle();
            });
            });
        });
 
</script>
<script>
    $(function(){
          $('table tbody tr').each(function(){
            $(this).find('.delete').click(function(){
              var id = $(this).attr('data-id');
              Swal.fire({
                        title: 'Are you sure you want to delete this news?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        customClass: {
                        popup: 'deletepopup'
                      }
                        }).then((result) => {
                        if (result.value) {
                            window.location.href = "/news/destroy/" + id;
                            Swal.fire(
                            {
                                title: "The news has been deleted!",
                                type: "success",
                                confirmButtonColor: "#3085d6",
                                customClass: {
                                    popup: 'deletepopup'
                                  }
                            }
                        );
                        }
                        })
            });
          });
        });
</script>
@endsection