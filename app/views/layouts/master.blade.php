<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>WeatherPanel</title>

        <!-- Bootstrap core CSS -->
        <link href="http:////netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ URL::asset('css/jquery.jqplot.css') }}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- Fixed navbar -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">WeatherPanel</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Dashboard</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Data <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ URL::to('data/malaysia') }}">Average tempartures Malaysia</a></li>
                                <!--<li class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="#">Separated link</a></li>
                                <li><a href="#">One more separated link</a></li>-->
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Export <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">All data</a></li>
                                <li><a href="#">Average temperatures</a></li>
                                <li><a href="#">Visibility in Africa</a></li>
                                <!--<li class="divider"></li>
                                <li class="dropdown-header">Nav header</li>
                                <li><a href="#">Separated link</a></li>
                                <li><a href="#">One more separated link</a></li>-->
                            </ul>
                        </li>
                    </ul>
                    
                    <p class="pull-right" style="margin-top: 15px;">Logged in as Admin</p>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="container" style="margin-top: 60px;">
            @yield('content')
        </div> <!-- /container -->
    </body>
    
    <script type="text/javascript" src="http://codeorigin.jquery.com/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
    
    <script type="text/javascript" src="{{ URL::asset('js/jquery.jqplot.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugins/jqplot.barRenderer.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugins/jqplot.categoryAxisRenderer.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('js/plugins/jqplot.pointLabels.min.js') }}"></script>
            
    <script type="text/javascript" src="{{ URL::asset('js/spul.js') }}"></script>
</html>
