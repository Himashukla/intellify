<div class="col-md-12">          
   @if(isset($errors) && count($errors) > 0)
   <div class="alert alert-danger alert-dismissible" role="alert" id="danger-msg" style="position: fixed;">
       <span class="alert-inner--icon"><i class="fa fa-thumbs-down"></i></span>
       <span class="alert-inner--text">
       @foreach ($errors->all() as $error)
       -> {{$error}}
       @endforeach
       <br/></span>
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
       </button>
   </div>    
   @endif 
  
   @if(session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" id="success-msg" role="alert" style="position: fixed;">
      <span class="alert-inner--icon"><i class="fa fa-thumbs-up"></i></span>
      <span class="alert-inner--text">{!! session()->get('success')!!}</span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  @endif

  @if(Session::has('message'))
  <div class="alert alert-danger alert-dismissible" role="alert" id="alert-msg" style="position: fixed;">
      <span class="alert-inner--icon"><i class="fa fa-thumbs-down"></i></span>
      <span class="alert-inner--text">{!! session()->get('message')!!}<br/></span>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  @endif
</div>