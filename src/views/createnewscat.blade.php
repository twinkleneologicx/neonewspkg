@extends('news::layout.app')
@section('content')
<style>
  .deletepopup{
    font-size: 12px;
  }
</style>
<div class="row" style="overflow-x:hidden; margin:0; margin-top:3%;">
  <div class="col-md-4"></div>
  <div class="col-md-4">
    <div class="card" style="background-color: #45a3d6;">
      <div class="card-body" style="color:#fff;">
        <h4 class="card-title">Add News Category</h4>
        <form action="{{route('newsCategory.store')}}" method="POST">
          @csrf
          <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" class="form-control" placeholder="News Cayegory" name="name" id="name" >

          </div>
          <div>
            <button type="submit" class="btn"
              style="background: #FF8F8C; border: 1px solid #FF8F8C;color: #fff; float: right; font-weight:500;">Submit</button>
          </div>
        </form>
      </div>
    </div>

  </div>
  <div class="col-md-4"></div>
</div>
@if(isset($data))
<div class="row" style="overflow-x:hidden; margin:0; margin-top:3%;">
  <div class="col-md-1"></div>
  <div class="col-md-10">
    <table class="table table-striped">
      <thead style="text-align:center;">
        <tr>
          <th>S.no.</th>
          <th>Category</th>
          <th>Date</th>
          <th>All News</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody style="text-align:center;">
        @foreach ($data as $key=>$item)
        <tr>
          <td>{{$key+1}}</td>
          <td>{{$item->name}}</td>
          <td>{{date('F d, Y', strtotime($item->created_at))}}</td>
          <td><a href="/allnews/{{$item->id}}" class="btn btn-info">News</a></td>
          <td> <a href="/newsCategory/{{$item->id}}/edit"><i class="fa fa-pencil" aria-hidden="true"></i></a> &nbsp; <a
            style="color:#007bff; cursor:pointer;" data-id="{{$item->id}}" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a> </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="col-md-1"></div>
</div>
<div style="float:right;">{{$data->links()}}</div>
@endif
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function(){
      $('table tbody tr').each(function(){
        $(this).find('.delete').click(function(){
          var id = $(this).attr('data-id');
          Swal.fire({
                    title: 'Are you sure you want to delete this category?',
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
                        window.location.href = "/newsCategory/destroy/" + id;
                        Swal.fire(
                        {
                            title: "The category has been deleted!",
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