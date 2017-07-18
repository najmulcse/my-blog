<script>
window.Laravel = <?php echo json_encode([
'csrfToken' => csrf_token(),
]); ?>
</script>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Najmul's Blog</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/myStyle.css')}}">
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{asset('css/clean-blog.css')}}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin.css')}}" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('js/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- Contact Form JavaScript -->
    <script src="{{asset('js/jqBootstrapValidation.js')}}"></script>
    <script src="{{asset('js/contact_me.js')}}"></script>

    <!-- Theme JavaScript -->
    <script src="{{asset('js/clean-blog.min.js')}}"></script>

</head>

<body id="app-layout">
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
               <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                @if (Auth::guest())
                <a class="navbar-brand" href="{{ url('/') }}">
                   Najmul's Blog
                </a>
                 @else
                    <a class="navbar-brand" href="{{ url('/home') }}">
                        Najmul's Blog
                    </a>
                  @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">


                <!-- Right Side Of Navbar started-->
                <ul class="nav navbar-nav navbar-right log_nav">


               
                    <li>
                        <a href="{{ url('/')}}">Home</a>
                    </li>
                   
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                       @if(Auth::user()->isAdmin())
                        <li><a href="{{ url('/admin')}}">Admin</a></li>
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif

               
                        
                </ul> <!-- Right Side Of Navbar ended-->
            </div>
            @if(Auth::check())
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
            
                @if(Auth::user()->isAdmin())
                <li class="active">
                        <a href="{{ route('admin')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="{{route('category')}}"><i class="fa fa-fw fa-table"></i> Categories</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#posts"> <i class="fa fa-th-large" aria-hidden="true"></i>   Posts <i class="fa fa-chevron-circle-down pull-right" aria-hidden="true"></i></a>
                        <ul id="posts" class="collapse">
                            <li>
                                <a  href="{{ route('createPost')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i>  Create Post</a>
                            </li>
                            <li>
                                <a href="{{route('allPostAdmin')}}"><i class="fa fa-globe" aria-hidden="true"></i>  All posts</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li class="active">
                        <a href="{{route('user.post')}}"><i class="fa fa-fw fa-group"></i>   My posts</a>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-user fa-fw""></i> Profile <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href=""> <i class="fa fa-unlock""></i> Changed Password</a>
                            </li>
                            <li>
                                <a href=""> <i class="fa fa-user""></i> Add Photo</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            @endif
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page header and search -->
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">  <!-- searching started -->
                        <form action="{{route('blog.search')}}" method="POST">
                        {{csrf_field()}}
                           <div class="input-group col-md-12 ">
                            <input type="text" class="input_search  search-query form-control " name="search_value" placeholder="Search" />
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="submit" name="search">
                                    <span class=" glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                          </div>
                        </form>
                    </div>  <!-- searching ended -->
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">  <!-- group creating button started -->
                        <ul class="pager">
                            <li class="next">
                                <a href="{{route('createPost')}}" class="btn ">Create Post </a>
                            </li>
                        </ul>   
                    </div>   <!-- group creating button ended -->
                </div> 
                <!-- Page header and search ended -->

                {{-- <div class="row">  
                        <div class="col-lg-12">  <!--Group heading started -->
                           @yield('group_heading')
                        </div><!--Group heading ended -->
                </div> --}}

                <div class="row"> <!--Group body started -->
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        @yield('blog_body')
                    </div> <!--Group body ended -->

                </div>
                </div> 
            </div>
               
               
                <!-- group body contents started -->

            <!-- /.container-fluid -->
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    

    
</body>

</html>
