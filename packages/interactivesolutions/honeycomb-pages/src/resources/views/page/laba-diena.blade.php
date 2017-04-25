<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>HoneyComb Laba diena</title>

    <!-- Bootstrap Core CSS -->
    @include('HCPages::css.core')
    @include('HCPages::js.global')
    {{--<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">--}}
    <!-- Custom CSS: You can use this stylesheet to override any Bootstrap styles and/or apply your own styles -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom Fonts from Google -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>

<!-- Navigation -->
    <nav id="siteNav" class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Logo and responsive toggle -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                	<span class="glyphicon glyphicon-fire"></span>
                	LOGO
                </a>
            </div>
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active">
    <a href="#">Laba diena</a>
</li><li class="active">
    <a href="#about">sadsadsa</a>
</li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

    <!-- Header -->
    <header style="background-image: url({{asset('resources/23924040-442a-4117-b6e8-0cdcbe7a6457 ')}}">
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Laba diena</h1>
                <p></p>
            </div>
        </div>
    </header>

    <!-- Intro Section -->
    <section id="intro" class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <span class="glyphicon glyphicon-apple" style="font-size: 60px"></span>
                    <h2 class="section-heading">sadsadsa</h2>
                    <p class="text-light"></p>
                </div>
            </div>
        </div>
    </section>
    <!-- Content 3 -->
<section id="about" class="content content-3">
    <div class="container">
        <h2 class="section-header"><span class="glyphicon glyphicon-pushpin text-primary"></span><br>sadsadsa</h2>
        <p class="lead text-muted">sadsadsadsad</p>
        

    </div>
    </div>
</section>

	<!-- Footer -->
    <footer class="page-footer">

        

        <!-- Copyright etc -->
        <div class="small-print">
        	<div class="container">
        		<p>Copyright &copy; HoneyComb 2017</p>
        	</div>
        </div>

    </footer>

    @include('HCPages::js.core')

</body>

</html>



