<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>HoneyComb Sveiki atvykę</title>

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
    <a href="#">Sveiki atvykę</a>
</li><li class="active">
    <a href="#about">Apie sistemą</a>
</li><li class="active">
    <a href="#contacts">Kontaktai</a>
</li>
                </ul>

            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav>

    <!-- Header -->
    <header style="background-image: url({{asset('resources/a3e79de4-70f8-4f75-b52c-31393752514b')}}">
        <div class="header-content">
            <div class="header-content-inner">
                <h1>Sveiki atvykę</h1>
                <p>Puslapis skirtas susipažinti su HoneyComb turinio valdymo sistema ir jos funkcionalumu</p>
            </div>
        </div>
    </header>

    <!-- Intro Section -->
    <section id="intro" class="intro">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <span class="glyphicon glyphicon-apple" style="font-size: 60px"></span>
                    <h2 class="section-heading">Ši turinio valdymo sistema skirta:</h2>
                    <p class="text-light"><p>o Kurti blogus, reprezentacinius puslapius<br />o Sistemas<br />o Modulius, skirtus laravel karkasui ar HoneyComb CMS</p></p>
                </div>
            </div>
        </div>
    </section>
    <!-- Content 3 -->
<section id="about" class="content content-3">
    <div class="container">
        <h2 class="section-header"><span class="glyphicon glyphicon-pushpin text-primary"></span><br>Apie sistemą</h2>
        <p class="lead text-muted">Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum</p>
        <a href="https://www.google.lt" class="btn btn-primary btn-lg">google.lt</a>

    </div>
    </div>
</section>

	<!-- Footer -->
    <footer class="page-footer">

        <!-- Contact Us -->
<section id="contacts">
    <div class="contact">
        <div class="container">
            <h2 class="section-heading">Kontaktai</h2>
            <p><span class="glyphicon glyphicon-earphone"></span><br>+3706123456789</p>
            <p><span class="glyphicon glyphicon-envelope"></span><br>mantyzzzajabyzz@gmail.com</p>
        </div>
    </div>
</section>

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



