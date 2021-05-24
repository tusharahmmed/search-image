<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Search Web Aplication by Tushar</title>
    <link rel="icon" href="img/image.png" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/spfa-style.css">

</head>
<body>
    <!-- Page Loader 
    <div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>

    </div>

    -->

    
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">
                <i class="fas fa-images mr-2"></i>
                Image Search
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button> 
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link nav-link-1 active" aria-current="page" href="index.html">Photos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-2" href="javascript:void(0)">Videos</a>
                </li>
            </ul> 
            </div> 
        </div>
    </nav>  

    <?php

    //pagination
    
    
    $dataPerPage = 28;
    
    // get submit data

    if((isset($_REQUEST['s']) && $_REQUEST['s']) or  ((!empty($_GET['page'])))){



    $page = (isset($_REQUEST['page'])) ? $_REQUEST['page'] : 1; 

    $imageName = (isset($_REQUEST['s'])) ? $_REQUEST['s'] : 'hi';;
    $dataPerPage = 28;

    $apiUrl = 'https://pixabay.com/api/?key=21755814-c9d064145c357e7fac13a8c67&q='.$imageName.'&image_type=photo&pretty=true&orientation=horizontal&per_page='.$dataPerPage.'&page='.$page.'';

    $json_data = file_get_contents($apiUrl);

    $data = json_decode($json_data);

    $totalImage = $data->totalHits;

    $totalPage = ceil($totalImage / $dataPerPage);

    }
    ?>

    <!-- Search Section -->

    <div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RE4wyTI?ver=c51c">
        <form class="d-flex tm-search-form" method="get">
            <input class="form-control tm-search-input" name="s" type="search" placeholder="<?php echo ucfirst($placehoader = (isset($imageName)) ? $imageName : 'Search Image'); ?>" aria-label="Search">
            <button class="btn btn-outline-success tm-search-btn" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
                Latest Photos
            </h2>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <form action="" class="tm-text-primary" method="get">

                    <input type="hidden" name="s" value="<?php echo $name = isset($imageName)? $imageName : ' '; ?>" >

                    Page <input name="page" type="text" value="<?php if(isset($_REQUEST['page'])){echo $_REQUEST['page'];}else{ echo 1;} ?>"  size="1" class="tm-input-paging tm-text-primary"> of <?php echo $tP = (isset($totalPage)) ? $totalPage : '0'; ?>
                
                </form>
            </div>
        </div>

        <!-- Gallery -->
        <div class="row tm-mb-90 tm-gallery">

        <!-- Images -->
        <?php 

        if(!empty($data)){

            $images = $data->hits;

            foreach($images as $image){
                
                $src = $image->webformatURL;
                $view = $image->views;
                $like = $image->likes;
                $tags = $image->tags;

                ?>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="<?php echo $src; ?>" alt="Image" class="img-fluid height">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?php echo $tags; ?></h2>
                        <a href="javascript:void(0)">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light"><i class="fas fa-heart"></i> <?php echo $like; ?></span>
                    <span><?php echo $view; ?> views</span>
                </div>
            </div>

      <?php      } // end foreach


        } // end if  ?>

        </div>
        
        <!-- row -->

        <?php 
            // pagination
            if(!empty($data)){
        ?>
        <div class="row tm-mb-90">
            <div class="col-12 d-flex justify-content-between align-items-center tm-paging-col">

                <?php 
                // prev url 

                $preUrl =$isFirst = ($page == 1)? 'javascript:void(0)' : '://tusharahmmed.github.io/search-image/?s='.$imageName.'&page='.$prev = $page-1;

                ?>


                <a href="<?php echo $preUrl; ?>" class="btn btn-primary tm-btn-prev mb-2">Previous</a>
                <div class="tm-paging d-flex">

                <?php 

                // start pagination
                
                for($i=1; $i<=7; $i++){

                    $activeClass = ($i == $page)? 'active' : '';

                   // $currentUrl = "//tusharahmmed.github.io/search-image/?s=".$imageName."&page=3".$i; 
                    
                ?>

                    <a href="<?php echo '//tusharahmmed.github.io/search-image/?s='.$imageName.'&page='.$i ; ?>" class="<?php echo $activeClass; ?> tm-paging-link"><?php echo $i; ?></a>

                <?php }
                
                // next url
                $nextUrl = $isLast = ($page == $totalPage)? 'javascript:void(0)' : '//tusharahmmed.github.io/search-image/?s='.$imageName.'&page='.$prev = $page+1;
                
                ?>

                </div>
                <a href="<?php echo $nextUrl; ?>" class="btn btn-primary tm-btn-next" ">Next Page</a>
            </div>            
        </div>
        <?php } ?>


    </div> <!-- container-fluid, tm-container-content -->

    <footer class="tm-bg-gray pt-5 pb-3 tm-text-gray tm-footer">
        <div class="container-fluid tm-container-small">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">About Me</h3>
                    <p>Hi! My name is <a target="_blank" rel="Profile" href="https://www.upwork.com/freelancers/~01d3a7f29ef09a0d49/">Tushar</a>. I am Web Developer since 2017.<br> Thank you for your time. Have a good day!</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                    <h3 class="tm-text-primary mb-4 tm-footer-title">Other Repository</h3>
                    <ul class="tm-footer-links pl-0">
                        <li><a href="#">Advertise</a></li>
                        <li><a href="#">Support</a></li>
                        <li><a href="#">Our Company</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 px-5 mb-5">
                    <ul class="tm-social-links d-flex justify-content-end pl-0 mb-5">
                        <li class="mb-2"><a href="https://facebook.com"><i class="fab fa-facebook"></i></a></li>
                        <li class="mb-2"><a href="https://twitter.com"><i class="fab fa-twitter"></i></a></li>
                        <li class="mb-2"><a href="https://instagram.com"><i class="fab fa-instagram"></i></a></li>
                        <li class="mb-2"><a href="https://pinterest.com"><i class="fab fa-pinterest"></i></a></li>
                    </ul>
                    <a href="#" class="tm-text-gray text-right d-block mb-2">Terms of Use</a>
                    <a href="#" class="tm-text-gray text-right d-block">Privacy Policy</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-7 col-12 px-5 mb-3">
                    Copyright 2021 SPFA TECH. All rights reserved.
                </div>
                <div class="col-lg-4 col-md-5 col-12 px-5 text-right">
                    Designed by <a href="https://www.facebook.com/spfa2015/" class="tm-text-gray" rel="sponsored" target="_blank">SPFA TECH</a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="js/plugins.js"></script>
    <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>
</body>
</html>