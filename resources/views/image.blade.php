<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Upload Image to Amazon s3 cloud Storage Using laravel</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 
  </head>
  <body>
    <div class="container">
           <div class="row pt-5">
               <div class="col-sm-12">
      <h2>Laravel Upload Image to Amazon s3 cloud Storage Tutorial</h2><br/>
      @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
     @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
  </div>

               <div class="col-sm-8">
                   @if (count($images) > 0)
                       <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                           <div class="carousel-inner">
                               @foreach ($images as $image)
                                   <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                       <img class="d-block w-100" src="{{ $image['src'] }}" alt="First slide">
                                       <div class="carousel-caption">
                                           <form action="{{ url('images/' . $image['name']) }}" method="POST">
                                               {{ csrf_field() }}
                                               {{ method_field('DELETE') }}
                                               <button type="submit" class="btn btn-default">Remove</button>
                                           </form>
                                       </div>
                                   </div>
                               @endforeach
                           </div>
                           <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                               <span class="sr-only">Previous</span>
                           </a>
                           <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                               <span class="carousel-control-next-icon" aria-hidden="true"></span>
                               <span class="sr-only">Next</span>
                           </a>
                       </div>
                   @else
                       <p>Nothing found</p>
                   @endif
               </div>
               <div class="col-sm-4">
      <form method="post" action="{{url('store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <input type="file" name="image">    
         </div>
        </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success">Upload</button>
          </div>
        </div>
      </form>
  </div>
</div>
    </div>
  </body>
</html>