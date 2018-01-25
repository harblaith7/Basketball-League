<html lang="en">

<head>
    <?php include "head.php"?>
</head>

<body id="body" class="b-element">
    <!-- Preloader -->
    <div id="preloader" class="smooth-loader-wrapper">
        <div class="smooth-loader">
            <div class="loader1">
                <div class="loader-target">
                    <div class="loader-target-main"></div>
                    <div class="loader-target-inner"></div>
                </div>
            </div>
        </div>
    </div>
    <?php include "nav.php";?>
    <div class="main-wrapper">
        <section class="">
            <div class="bg-image-holder bredcrumb bg-primary">
                <!-- style="background-image: url('img/promo-1.jpg');" -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h2>Teams </h2>
                            <hr class="hr_narrow  hr_color">
                        </div>
                    </div>
                </div>
                <!-- container ends -->
            </div>
        </section>
        <section class="home-blog bg-sand">
            <div class="container">
                <!-- section title ends -->
                <div class="row ">
                    <div class="col-md-6">
                        <div class="media blog-media" data-toggle="modal" data-target="#exampleModalLong2">
                            <img class="d-flex" src="img/blog/b1.jpg" alt="Generic placeholder image">
                            <div class="circle">
                                <h5 class="day">14</h5>
                                <span class="month">sep</span>
                            </div>
                            <div class="media-body">
                                <a href="">
                                    <h5 class="mt-0">Standard Blog Post</h5>
                                </a> Sodales aliquid, in eget ac cupidatat velit autem numquam ullam ducimus occaecati placeat error.
                                <a href="blog-post-left-sidebar.html" class="post-link">Read More</a>
                                <ul>
                                    <li>by: Admin</li>
                                    <li class="text-right"><a href="blog-post-left-sidebar.html">07 comments</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal -->
        <div class="modal fade " id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close push-xs-right" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-close"></i>
						</button>
                        <div class="container-fluid modal-item">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single_item-img">
                                        <img src="img/modal1.jpg" alt="image">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single_item-details">
                                        <h2>Modal Title</h2>

                                        <p class="pv30">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio assumenda numquam dolor illo praesentium.
                                        </p>
                                        <ul class="list-group no-border">
                                            <li class="list-group-item"><a href="#"><i class="fa fa-dot-circle-o"></i> icon List item without border</a></li>
                                            <li class="list-group-item"><a href="#"><i class="fa fa-dot-circle-o"></i> icon List item without border</a></li>
                                            <li class="list-group-item"><a href="#"><i class="fa fa-dot-circle-o"></i> icon List item without border</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <?php include "foot-nav.php";?>
    </div>


    <!-- JAVASCRIPTS -->
    <?php include "js-compile.php";?>

</body>

</html>
