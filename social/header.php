<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">

    <!-- Meta -->
    <title>Moving Monsters Social</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Icons -->
    <link rel="shortcut icon" type="image/x-icon" href="images/icons/favicon.ico">

    <link rel="apple-touch-icon-precomposed" href="images/icons/favicon-152.png">
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="images/icons/favicon-152.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/icons/favicon-144.png">
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="images/icons/favicon-120.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/icons/favicon-114.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/icons/favicon-72.png">
    <link rel="apple-touch-icon-precomposed" href="images/icons/favicon-57.png">
    <link rel="icon" href="images/icons/favicon-32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="msapplication-TileImage" content="images/icons/favicon-144.png">

    <!-- Scripts -->
    <script src="js/jquery-v2.0.3.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/custom.css" />
    <link rel="stylesheet" type="text/css" href="./fonts/opensans/opensans.css" />

</head>
<body>

<header>
    <nav class="navbar navbar-default navbar-inverse" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Login dropdown</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Social</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Inloggen</b> <span class="caret"></span></a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                                                <div class="help-block text-right"><a href="">Wachtwoord vergeten?</a></div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Inloggen</button>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox">Ingelogd blijven
                                                </label>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="bottom text-center">
                                        Nieuw hier? <a href="#"><b>Wat is Moving Monsters?</b></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>