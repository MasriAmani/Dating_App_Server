<html>

<head>
    <title>
        Admin
    </title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a class="navbar-brand" href="#">Mingle</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item" >
            </li>
           
          </ul>
          <form class="form-inline my-2 my-lg-0" method="get" action ="{{ route('adminlogout') }}" >
           
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">logout</button>
          </form>
        </div>
        </div>
      </nav>
    
    
           
       <table style="width:90% ;margin-left:5% ; margin-right:5%;margin-top:5%">
          <thead>
           <td> Messages</td>
           <td> Approve</td>
           <td> Decline</td>
          </thead>
          <tbody>
        @foreach($data as $item )
        <tr><td>{{$item->body}}</td>
        <td><form method="get" action ="{{ route('api:approvemsg') }}">
            <input type="hidden" name="id" value="{{$item->id}}">
            <button class="login100-form-btn" type="submit" style="background-color:rgb(81, 168, 81);"> 
                APPROVE
            </button></form></td>
            <td><form method="get" action ="{{ route('api:declinemsg') }}">
                <input type="hidden" name="id" value="{{$item->id}}">
                <button class="login100-form-btn" type="submit" style="background-color:#d3544b;" >
                  Decline
                </button></form></td>
            </tr>
         @endforeach 
        </tbody>
    </table>
</div>
      
</body>
</html>