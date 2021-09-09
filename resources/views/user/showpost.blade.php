@extends('../layouts.app')


@section('content')

<br>
<br>
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                {{-- <table class="table">
                    <thead>
                        <tr>
                          <th  scope="col" colspan="5">{{__('user/dash.ID')}} </th>

                        </tr>
                      </thead>
                      <tbody>

                        <tr style="text-align: center">
                          <th scope="row">{{$post->id}}</th>
                     
                    </tr>

                </tbody>
                      <thead>
                        <tr>
                          <th  scope="col" colspan="5">{{__('user/dash.Title')}} </th>
                        
  
                        </tr>
                      </thead>
                      <tbody>

                        <tr style="text-align: center">
                      
                        <td>{{$post->name}}</td>
                       
                    </tr>

                </tbody>

                      <thead>
                        <tr>
                       
                          <th  scope="col" colspan="5" >{{__('user/dash.description')}} </th>
                        
  
                        </tr>
                      </thead>
                      <tbody>

                        <tr style="text-align: center">
                       
                        <td >{{$post->description}}  </td>
                    
                    </tr>

                </tbody>
                      <thead>
                        <tr>
                      
                          <th  scope="col" colspan="5">{{__('user/dash.tag')}} </th>
                       
  
                        </tr>
                      </thead>
                      <tbody>

                        <tr style="text-align: center">
                    
                        <td>{{$post->tag}}  </td>
                         </tr>

                </tbody>


                      <thead>
                        <tr>
                    
                          <th  scope="col" colspan="5">{{__('user/dash.category')}}</th>
                    
                        </tr>
                      </thead>
                      <tbody>

                        <tr style="text-align: center">
                          <td>{{$post->category}} </td>
                          </tr>

                </tbody>


                <thead>
                  <tr>
              
                    <th  scope="col" colspan="5">{{__('user/dash.Photo')}}</th>
              
                  </tr>
                </thead>
                <tbody>

                  <tr style="text-align: center">
                <td> <img width="500px"  height="500px" src="{{asset('images/' . $post->file)}}" alt=""> </td>
                    </tr>

          </tbody>

                      <thead>
                        <tr>
                        
                          <th  scope="col"  colspan="5"> {{__('user/dash.Edit')}} </th>
  
                        </tr>
                      </thead>
                    <tbody>

                        <tr>
                     

                        <td> <a href="{{Url('editpost').'/'.$post->id}}"> <i class="far fa-edit"></i> </a> </td>
                        <td> <a href="{{Url('delete').'/'.$post->id}}" onClick="return confirm('Are you sure ?')"> <i class="far fa-trash-alt"></i> </a> </td>
                    </tr>

                </tbody>
                  </table> --}}


                  {{-- <div class="container"> --}}
                    {{-- <div class="row"> --}}
                        <!-- Blog entries-->
                        {{-- <div class="col-lg-12"> --}}
                            <!-- Featured blog post-->
        

                {{-- </div> --}}
                {{-- </div> --}}
              {{-- </div> --}}


              <div class="card mb-4">
                <a href="#!"><img class="card-img-top"  height="300" src="{{asset('images/' . $post->file)}}" alt="..." /></a>
                <div class="card-body">
                    <div class="small text-muted">{{__('Created at:')}}<br>{{$post->created_at }}</div>
                    <div class="small text-muted">{{__('Posted by:')}}<br>{{$post->created_at }}</div>
                    <h2 class="card-title">{{__('Title:')}}<br>{{Str::limit($post->name,  50, '...') }}</h2>
                    <p class="card-text">{{__('Content:')}}<br>{{Str::limit($post->description,  250, '...') }} </p>
                    <p class="card-text">{{__('category:')}}<br>{{Str::limit($post->category,  250, '...') }} </p>
                    <p class="card-text">{{__('tag:')}}<br>{{Str::limit($post->tag  ,  250, '...') }} </p>
                                
            @if (Auth::user()->id==$post->user_id)
                
            <div>
              <div class="row justify-content-center">{{__('Edit:')}}
                <center>
                <a  href="{{Url('editpost').'/'.$post->id}}"> <i class="far fa-edit"></i> </a>
                <a  href="{{Url('delete').'/'.$post->id}}" onClick="return confirm('Are you sure ?')"> <i class="far fa-trash-alt"></i> </a>

                </center>
                </div>

            </div>
            @endif

              @if (count($commentswithuser)>0)
                  
              <div class="card mb-2">
                <div class="card-body ">
                  @foreach ($commentswithuser as $comment)
                  <div class="card mb-2">
                      
                  <div class="small text-muted ">{{$comment->content}} </div>
                  <div class="small text-muted">{{__('Created by : ')}}{{$comment->created_at}} </div>
                  <div class="small text-muted">{{__('Commented by : ')}}{{$comment->getUsers->name}} </div>
                
                  @if (Auth::user()->id== $comment->user_id)
                
                  <div>
                    {{-- <div class="row justify-content-center">{{__('Edit:')}} --}}
                      <center>
                      <a  href="{{Url('showpost').'/'.$post->id.'/'.('comment').'/'.$comment->id}}"> <i class="far fa-edit"></i> </a>
                      <a  href="{{Url('comment-delete').'/'.$comment->id}}" onClick="return confirm('Are you sure ?')"> <i class="far fa-trash-alt"></i> </a>
      
                      </center>
      
                  </div>
                  @elseif (Auth::user()->admin_status== 1)
                  <div>
                    {{-- <div class="row justify-content-center">{{__('Edit:')}} --}}
                      <center>
                      <a  href="{{Url('comment-delete').'/'.$comment->id}}" onClick="return confirm('Are you sure ?')"> <i class="far fa-trash-alt"></i> </a>
      
                      </center>
      
                  </div>
                  @endif

                </div>

                  @endforeach

              </div>

              </div>

              @endif


                    <div class="card-body">
                      <form action="{{route('newcomment')}}"  method="get">
                      <div class="small text-muted"> Comment</div>
                      <input style=" width: 100%;" name="content" type="text">
                      <input type="hidden" name="post_id" value="{{$post->id}}">

                      </form>

                  </div>

                  </div>
            </div>

            <a href="{{route('newpost')}}"  class="btn btn-success">{{__('user/dash.Create New')}} </a>
            <br>
            <a href="{{url('/')}}"  class="btn btn-dark">{{__('user/dash.Back To Home')}} </a>
            </div>

            </div>
        </div>
    </div>
</div>
@endsection


