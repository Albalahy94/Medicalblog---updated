<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="auto">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield(__('login.Dashboard '), __('login.Medical Blog'))</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    
    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
    <div id="app"  class="sb-nav-fixed">

        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{route('all-posts')}}">{{__('login.Medical Blog')}}</a>
           

           @auth
            <?php

            $userid = Auth::user('id')->admin_status;
            $pending = Auth::user('id')->pending;

            ?>
           

            <!-- Sidebar Toggle-->
            @if($userid  == 1) 
                <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            @endif
            <!-- Navbar Search-->
            @if($pending  == 0) 

            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>    
            @endif
            @else
           @endauth

            <!-- Navbar-->
            
             <!-- Right Side Of Navbar -->
             <ul class="navbar-nav ml-auto" style="justify-content: flex-end;
             width: -webkit-fill-available;">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li class="nav-item ">
                    <a class="nav-link "rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }} 
                    </a>
                </li> 
            @endforeach


            <!-- Authentication Links -->
            @auth
            <li class="dropdown dropdown-notification nav-item  dropdown-notifications">
                <a class="nav-link nav-link-label" href="#" data-toggle="dropdown">
                    <i class="fa fa-bell"> </i>
                    <span
                        class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow   notif-count"
                        data-count="0">0</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <h6 class="dropdown-header m-0 text-center">
                            <span class="grey darken-2 text-center"> الرسائل</span>
                        </h6>
                    </li>
                    <li class="scrollable-container ps-container ps-active-y media-list w-100">
                        <a href="">
                            <div class="media">
                                <div class="media-body">
                                    <h6 class="media-heading text-right ">عنوان الاشعار </h6>
                                    <p class="notification-text font-small-3 text-muted text-right"> نص الاشعار</p>
                                    <small style="direction: ltr;">
                                        <p class=" text-muted text-right"
                                              style="direction: ltr;"> 20-05-2020 - 06:00 pm
                                        </p>
                                        <br>

                                    </small>
                                </div>
                            </div>
                        </a>

                    </li>
                    <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                                        href=""> جميع الاشعارات </a>
                    </li>
                </ul>
            </li>
        @endauth

            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('login.Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('login.Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('login.Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                <li>
                    <a id="navbarDropdown" class="nav-link " href="{{route('show')}}" role="button" >
                        {{__('My Posts')}}
                    </a>
                </li>
            @endguest
        </ul>
         
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>



    <div style="display: grid;
    grid-template-columns: auto;
    grid-template-rows: auto;
    grid-row-end: initial;
    align-content: end;
    height: inherit;
   ">
      @include('../layouts/footer')
   </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{asset('js/datatables-simple-demo.js')}}"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://js.pusher.com/6.0/pusher.min.js"></script>

<script>
    
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;
    
    var pusher = new Pusher('b806b15dd1c82d80b53f', {
        cluster: 'eu',
        encrypted: false
    });
    var notificationsWrapper = $('.dropdown-notifications');
var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
var notificationsCountElem = notificationsToggle.find('span[data-count]');
var notificationsCount = parseInt(notificationsCountElem.data('count'));
var notifications = notificationsWrapper.find('li.scrollable-container');

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('new-notification');
// Bind a function to a Event (the full Laravel class)
channel.bind('App\\Events\\NotifyUsers', function (data) {
    var existingNotifications = notifications.html();
    var newNotificationHtml = `<a href="`+data.user_id+`"><div class="media-body"><h6 class="media-heading text-right">` + data.user_name + `</h6> <p class="notification-text font-small-3 text-muted text-right">` + data.comment + `</p><small style="direction: ltr;"><p class="media-meta text-muted text-right" style="direction: ltr;">` + data.date + data.time + `</p> </small></div></div></a>`;
    notifications.html(newNotificationHtml + existingNotifications);
    notificationsCount += 1;
    notificationsCountElem.attr('data-count', notificationsCount);
    notificationsWrapper.find('.notif-count').text(notificationsCount);
    notificationsWrapper.show();
});

    // var channel = pusher.subscribe('notify-users');
    // channel.bind('App\\Events\\NotifyUsers', function(data) {
    // alert(JSON.stringify(data));
    // });
    </script>
    
{{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
 
     // Enable pusher logging - don't include this in production
     Pusher.logToConsole = true;
 
     var pusher = new Pusher('b806b15dd1c82d80b53f', {
        'cluster': 'eu',
        'encrypted' :false,
        forceTLS: true

     });


   </script>
   --}}
   {{-- <script src="{{asset('js/pusherNotifications.js')}}"></script> --}}
</body>
</html>