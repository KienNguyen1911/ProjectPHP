<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Source+Serif+Pro:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="Views/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="Views/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="Views/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="Views/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="Views/assets/fonts/icomoon/style.css">
    <link rel="stylesheet" href="Views/assets/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="Views/assets/css/daterangepicker.css">
    <link rel="stylesheet" href="Views/assets/css/aos.css">
    <link rel="stylesheet" href="Views/assets/css/style.css">

    <title>Tour Free Bootstrap Template for Travel Agency by Untree.co</title>
</head>

<body>
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close">
                <span class="icofont-close js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>

    <nav class="site-nav">
        <div class="container">
            <div class="site-navigation">
                <a href="index.php?controller=page&action=index" class="logo m-0">Tour <span class="text-primary">.</span></a>

                <ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu float-right">
                    <li><a href="index.php?controller=page&action=index">Home</a></li>
                    <li><a href="index.php?controller=page&action=elements">Elements</a></li>
                    <li><a href="index.php?controller=motel&action=showMotelPage">Motels</a></li>
                    <li><a href="index.php?controller=page&action=services">Services</a></li>
                    <li class="active"><a href="index.php?controller=page&action=about">About</a></li>
                    <li><a href="index.php?controller=page&action=contact">Contact Us</a></li>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li class="has-children">
                            <a href="#"><?php echo $_SESSION['user']['username'] ?></a>
                            <ul class="dropdown">
                                <li><a href="index.php?controller=page&action=elements">Elements</a></li>
                                <?php 
                                    if ($_SESSION['user']['role'] == "admin" || $_SESSION['user']['role'] == "owner") {
                                        echo '<li><a href="index.php?controller=booking&action=getBookingsByUserId">Your Bookings</a></li>';
                                        echo '<li><a href="index.php?controller=admin&action=dashboard">Admin Page</a></li>';
                                    }
                                ?>
                                <li><a href="index.php?controller=login&action=signOut">Log Out</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li><a href="index.php?controller=page&action=login">Log In</a></li>
                    <?php endif; ?>
                </ul>

                <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
                    <span></span>
                </a>

            </div>
        </div>
    </nav>
</body>