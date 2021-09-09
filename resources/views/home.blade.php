@extends('layouts.app')

@section('content')

<br>
<br>
 

{{-- <div class="container"> --}}
        <!-- Responsive navbar-->
        {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">Start Bootstrap</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">Contact</a></li>
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Blog</a></li>
                    </ul>
                </div>
            </div>
        </nav> --}}
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Medical Blog Home!</h1>
                    {{-- <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p> --}}
                </div>
            </div>
        </header>
        
<div class="container">
  
    @if(Session::has('success'))
    
    <div class="alert alert-success">
    {{Session::get('success')}}
       </div>  
       @endif
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
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
                    <div style="text-align: center">
                        {!! $posts->onEachSide(5)->links() !!}

                    </div>


                    {{-- <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item disabled"><a class="page-link" href="{{ $posts->previousPageUrl() }}" tabindex="-1" aria-disabled="true">Newer</a></li>
                            <li class="page-item"><a class="page-link" href="{{ $posts->links()->first_page_url }}">{{ $posts->firstItem() }}</a></li>
                            @foreach ($posts as $link)
                                
                            <li class="page-item active" aria-current="page"><a class="page-link" href="{{ $link->nextPageUrl() }}">1</a></li>
                            @endforeach
                            <li class="page-item active" aria-current="page"><a class="page-link" href="{{ $posts->nextPageUrl() }}">1</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                            <li class="page-item"><a class="page-link" href="?page={{ $posts->lastPage() }}">{{ $posts->lastPage() }}</a></li>
                            <li class="page-item"><a class="page-link" href="{{ $posts->nextPageUrl() }}">Older</a></li>
                        </ul>
                    </nav> --}}
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    {{-- <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($categories as $category)
                                        <li><a style="
                                            text-decoration: none;
                                            color: #5c5757;
                                            font-size: 19px;
                                            font-weight: bold;
                                        " 
                                        href="{{route('category',$category->category)}}">{{$category->category}}</a></li>
                                            
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">Tags</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($tags as $tag)
                                        <li><a style="
                                            text-decoration: none;
                                            color: #5c5757;
                                            font-size: 19px;
                                            font-weight: bold;
                                        " 
                                         href="{{route('tag',$tag->tag)}}">{{$tag->tag}}</a></li>
                                            
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Side widget-->
                    {{-- <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                    </div> --}}
                </div>
            </div>
        {{-- </div> --}}
        <!-- Footer-->
        {{-- <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer> --}}
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script></div>
@endsection
