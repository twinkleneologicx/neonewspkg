<!DOCTYPE html>
<html lang="en">

<head>
  <title>Create Category</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <style>
      .zoom{
        transform: scale(5.5);
      }
    </style>
</head>

<body>
  {{-- {{dd($category)}} --}}
  <nav class="navbar navbar-expand-sm navbar-dark" style="background: #45a3d6;">
    <!-- Brand -->
    <a class="navbar-brand" href="/"></a>

    <!-- Links -->
    <ul class="navbar-nav">
      {{-- <li class="nav-item">
        <a class="nav-link" style="color:#fff; font-weight:500;" href="/admin/home">Home</a>
      </li> --}}
      {{-- <li class="nav-item">
        <a class="nav-link" style="color:#fff; font-weight:500;" href="/category">Manage Gallery</a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" style="color:#fff; font-weight:500;" href="/newsCategory">Manage News</a>
      </li>
    </ul>

    {{-- <a href="/logout" class="btn btn-danger" style="color: #fff; position: relative; right: -660px;">Logout <i class="fa fa-power-off" aria-hidden="true"></i></a> --}}
  </nav>
  <br>
  @if (session()->has('msg'))
<div class="alert alert-success" id="msg">
    {{session()->get('msg')}}
  </div>
@endif
{{-- {{dd($errors)}} --}}


  @yield('content')
  <script>
        $(function(){
          $('#msg').fadeOut(5000);
        });
        </script>
        <script>
            $(function(){
              $('.zoomhover').each(function(){
                $(this).mouseover(function(){
                  $(this).addClass('zoom');
                });
                $(this).mouseout(function(){
                  $(this).removeClass('zoom');
                });
              });
            });
          </script>

</body>

</html>