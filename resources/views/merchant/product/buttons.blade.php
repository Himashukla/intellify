<form method="POST" action="{{route("products.destroy",$row->id)}}"> 
   @csrf

   @if($row->status == 'Enable')
      <a href="{{route("products.status",$row->id)}}" class="btn btn-warning btn-sm m-1">Disable</a>
   @else 
      <a href="{{route("products.status",$row->id)}}" class="btn btn-success btn-sm m-1">Enable</a>
   @endif

   <a href="{{route("products.edit",$row->id)}}" class="btn btn-primary btn-sm m-1">Edit</a>

   <input type="hidden" name="_method" value="DELETE">  
   <button type="submit" onclick="return confirm('Do you really want to Delete Product? You cannot undone this.')" class="btn btn-danger btn-sm m-1" name="submit">Delete</button>
</form>