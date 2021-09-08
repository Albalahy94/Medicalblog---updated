
@extends('../layouts.app')


@section('content')

<br>
<br>
<br>
{{-- <div class="container">
  
  @if(Session::has('success'))
  
  <div class="alert alert-success">
  {{Session::get('success')}}
     </div>  
  @endif --}}
    {{-- <div class="row justify-content-center"> --}}
        {{-- <div class="col-md-12"> --}}
            {{-- <div class="card"> --}}
              
              {{-- <table class="table">
                <thead>
                      <tr>
                        <th scope="col"> {{__('user/dash.ID')}} </th>
                        <th scope="col"> {{__('user/dash.Title')}} </th>
                        <th scope="col"> {{__('user/dash.description')}} </th>
                        <th scope="col"> {{__('user/dash.tag')}} </th>
                        <th scope="col"> {{__('user/dash.category')}} </th>
                        <th scope="col"> {{__('user/dash.Photo')}} </th> 
                        <th scope="col" colspan="3">  {{__('user/dash.Edit')}}   </th>

                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post) 
                      <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td>{{Str::limit($post->name,  10, '...') }}</td>
                        <td>{{Str::limit($post->description,  10, '...') }}  </td>
                        <td>{{Str::limit($post->tag,  10, '...') }}  </td>
                        <td>{{Str::limit($post->category,  10, '...') }} </td>
                        <td>{{Str::limit($post->file,  10, '...') }} </td>

                        <td> <a href="{{Url('showpost').'/'.$post->id}}"> <i class="far fa-eye"></i> </a> </td>

                        <td> <a href="{{Url('editpost').'/'.$post->id}}"> <i class="far fa-edit"></i> </a> </td>
                        <td> <a href="{{Url('delete').'/'.$post->id}}" onClick="return confirm('Are you sure ?')"> <i class="far fa-trash-alt"></i> </a> </td>
                    </tr>
                    @endforeach
                   </tbody>
                  </table> --}}
                  <div class="container">
  
                    @if(Session::has('success'))
                    
                    <div class="alert alert-success">
                    {{Session::get('success')}}
                       </div>  
                       @endif
                        <!-- Page content-->
                        <div class="container">
                            <div >
                                <!-- Blog entries-->
                                <div class="">
                                    <!-- Featured blog post-->
                
                                    @foreach ($posts as $post)
                                    <div class="card mb-4">
                                        <a href="#!"><img class="card-img-top" width="500" height="300" src="{{asset('images/' . $post->file)}}" alt="..." /></a>
                                        <div class="card-body">
                                            <div class="small text-muted">{{$post->created_at }}</div>
                                            <h2 class="card-title">{{Str::limit($post->name,  50, '...') }}</h2>
                                            <p class="card-text">{{Str::limit($post->description,  250, '...') }} </p>
                                            <a class="btn btn-primary" href="{{Url('showpost').'/'.$post->id}}">Read more → </a>
                                        </div>
                                        {{-- <div class="card-body">
                                            @foreach ($post_comments as $comment)
                                                
                                            <div class="small text-muted">{{$comment}} </div>
                                            @endforeach
                
                                        </div>
                                        <div class="card-body">
                                            <form action="{{route('newcomment')}}"  method="get">
                                            <div class="small text-muted"> Comment</div>
                                            <input style=" width: 100%;" name="content" type="text">
                                            <input type="hidden" name="post_id" value="{{$post->id}}">
                    
                                            </form>
                
                                        </div> --}}
                                    </div>
                
                                    @endforeach
                                    <!-- Nested row for non-featured blog posts-->
                                    {{-- <div class="row">
                                        <div class="col-lg-6">
                                            <!-- Blog post-->
                                            <div class="card mb-4">
                                                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                                <div class="card-body">
                                                    <div class="small text-muted">January 1, 2021</div>
                                                    <h2 class="card-title h4">Post Title</h2>
                                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla.</p>
                                                    <a class="btn btn-primary" href="#!">Read more →</a>
                                                </div>
                                            </div>
                                            <!-- Blog post-->
                                            <div class="card mb-4">
                                                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                                <div class="card-body">
                                                    <div class="small text-muted">January 1, 2021</div>
                                                    <h2 class="card-title h4">Post Title</h2>
                                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla.</p>
                                                    <a class="btn btn-primary" href="#!">Read more →</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <!-- Blog post-->
                                            <div class="card mb-4">
                                                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                                <div class="card-body">
                                                    <div class="small text-muted">January 1, 2021</div>
                                                    <h2 class="card-title h4">Post Title</h2>
                                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla.</p>
                                                    <a class="btn btn-primary" href="#!">Read more →</a>
                                                </div>
                                            </div>
                                            <!-- Blog post-->
                                            <div class="card mb-4">
                                                <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                                <div class="card-body">
                                                    <div class="small text-muted">January 1, 2021</div>
                                                    <h2 class="card-title h4">Post Title</h2>
                                                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis aliquid atque, nulla? Quos cum ex quis soluta, a laboriosam.</p>
                                                    <a class="btn btn-primary" href="#!">Read more →</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- Pagination-->
                                    <nav aria-label="Pagination">
                                        <hr class="my-0" />
                                        <ul class="pagination justify-content-center my-4">
                                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">15</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                </div>
                            </div>
                  
                  
                  <a href="{{route('newpost')}}"  class="btn btn-success">   {{__('user/dash.Create New')}} </a>
                </div>
              </div>
            </div>
            
          </div>
        </div>
 <br>
 
   {{-- <div>
          {{$posts->links();}}

        </div> --}}
@endsection
