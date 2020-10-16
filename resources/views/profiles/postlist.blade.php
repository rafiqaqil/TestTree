@extends('layouts.boot')

@section('content')

 
    
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            List</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                  <tr>
                    <th >List</th>
                     <th >List</th>
                  </tr>
                </thead>
       
                <tbody>
            
                
        
        @foreach($user->posts as $post)
         <tr>
       
          
          
                
                  
                        <td >   <h6>{{ $post->caption }}</h6>
                           
                <a href="/p/{{ $post->id }}">
                    <button class='btn btn-info'>Apply</button>
                </a>
             
               
              
            </td>
                        <td > <img src="/storage/{{ $post->image }}" class="img-fluid" ></td>
                   
         </tr>
                 
               
       
                    
          
                
                
                
                   
                 
                  
                  
              
                   
        @endforeach
        
       
        </tr>
        
                </tbody>
              </table>
            </div>
          </div> </div>

           
        
  
@endsection
