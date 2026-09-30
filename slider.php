



<div class="banner-area content-top-heading text-normal heading-weight-600">
    <div id="bootcarousel" class="carousel slide animate_text" data-ride="carousel">

        <!-- Wrapper for slides -->
        <div class="carousel-inner text-light">
            <?php
            $SLIDER = new Slider(NULL);
            foreach ($SLIDER->all() as $key => $slider) {
                if ($key != 0) {
                    ?>
                    <div class="item">
                        <div class="box-table shadow bg-fixed dark" style="background-image: url(upload/slider/<?php echo $slider['image_name'] ?>);">
                            <div class="box-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="content">
                                                <h1 data-animation="animated fadeInUp" class=""><?php echo $slider['title'] ?></h1>
                                                <p data-animation="animated fadeInUp" class="">
                                                    <?php echo $slider['short_description'] ?>
                                                </p>
                                                <a data-animation="animated fadeInDown" class="btn circle btn-light effect btn-md" href="#">View Courses</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="item active">
                        <div class="box-table bg-fixed shadow dark" style="background-image: url(upload/slider/<?php echo $slider['image_name'] ?>);">
                            <div class="box-cell">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="content">
                                                <h1 data-animation="animated fadeInUp" class="animated fadeInUp"><?php echo $slider['title'] ?></span></h1>
                                                <p data-animation="animated fadeInUp" class="animated fadeInUp">
                                                    <?php echo $slider['short_description'] ?>
                                                </p>
                                                <a data-animation="animated fadeInDown" class="btn circle btn-light effect btn-md animated fadeInDown" href="#">View Courses</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
            }
            ?>
        </div>
        <!-- End Wrapper for slides -->

        <!-- Left and right controls -->
        <a class="left carousel-control shadow" href="#bootcarousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control shadow" href="#bootcarousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
            <span class="sr-only">Next</span>
        </a>

    </div>
</div>