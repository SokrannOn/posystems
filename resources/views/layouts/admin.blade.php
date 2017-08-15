<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Purchase Order</title>

    <!-- Bootstrap Core CSS -->
    @yield('css')
    <!-- <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <!-- DataTables CSS -->
    <link href="{{asset('vendor/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="{{asset('vendor/datatables-responsive/dataTables.responsive.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <!---<link href="{{asset('dist/css/sb-admin-2.css')}}" rel="stylesheet">-->
        
    <script src="{{asset('js/jquery-1.12.4.js')}}" type="text/javascript"></script>
    
    
    <script src="{{asset('js/select2.full.min.js')}}" type="text/javascript"></script>
    
    <!-- MetisMenu CSS -->
    <link href="{{asset('vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('vendor/morrisjs/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #2874A6 ;" >
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('dashbords.index') }}" style="color: #fff;">Camsofts</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a style="color: #fff; font-size: 11px;" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                        {{ Auth::user()->nameDisplay }}
                        <span class="caret"></span>                        
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li> -->
                        <li><a href="{{ url('admin/resets',Auth::user()->id)}}"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="fa fa-sign-out pull-right" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                {!!Form::hidden('user_id',Auth::user()->id,[])!!}
                            </form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
    <!-- /.navbar-top-links -->
    <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       

        @if(Auth::user()->position->name == 'Superuser')
            @include('nav.navi')
        @elseif(Auth::user()->position->name == 'Administrator')
            @include('nav.navi')
        @elseif(Auth::user()->position->name == 'IT')
            @include('nav.navi')
        @elseif(Auth::user()->position->name == 'Accountant')
            @include('nav.account')
        @elseif(Auth::user()->position->name == 'Sale')
            @include('nav.sale')
        @elseif(Auth::user()->position->name == 'Stock')
            @include('nav.stock')
        @elseif(Auth::user()->position->name == 'SD')
            @include('nav.sd')
        @endif   
                    </ul>
            </div>
        </div>
        </nav>

        <div id="page-wrapper">
        	@yield('content')
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    
    <!---<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>-->
    @yield('script')
    
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <!-- <script src="numeral.min.js"></script> -->
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('vendor/metisMenu/metisMenu.min.js')}}"></script>

    <!-- Morris Charts JavaScript -->
    <script src="{{asset('vendor/raphael/raphael.min.js')}}"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.1.min.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="{{asset('js/sb-admin-2.js')}}"></script>


</body>

</html>
