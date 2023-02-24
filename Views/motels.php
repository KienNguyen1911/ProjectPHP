<?php
require 'layout/header.php';
require 'Views/admin/layout_admin/header.php';
?>

<body>

    <div class="hero hero-inner" style="background-image: url(Views/assets/img/home-decor-1.jpg);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mx-auto text-center">
                    <div class="intro-wrap">
                        <h1 class="mb-0">Rooms</h1>
                        <p class="text-white">Far far away, behind the word mountains, far from the countries Vokalia
                            and Consonantia, there live the blind texts. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="untree_co-section">
        <div class="container">
            <div class="row">

                <?php foreach ($motels as $motel):
                    $imageMotel = $this->motelImage($motel); ?>

                    <div class="col-lg-3 col-md-4 col-sm-1">
                        <div class="card my-2" style="height: 370px;">
                            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                <a href="index.php?controller=motel&action=motelDetail&id=<?php echo $motel['id'] ?>" class="d-block">
                                    <img src="<?php echo $imageMotel['image_name'] ?>" class="img-fluid border-radius-lg">
                                </a>
                            </div>

                            <div class="card-body pt-2 d-flex"
                                style="flex-direction: column; justify-content: space-evenly;">
                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2"><?php
                                echo $motel['province_name'] ?></span>
                                <a href="index.php?controller=motel&action=motelDetail&id=<?php echo $motel['id'] ?>" class="card-title h5 d-block text-darker">
                                    <?php echo $motel['name'] ?>
                                </a>
                                <div class="author align-items-center">
                                    <div class="name">
                                        <span>Price: $
                                            <?php echo $motel['price'] ?>/night
                                        </span>
                                        <div class="stats">
                                            <small>Posted on 28 February</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>
        </div>
    </div>

</body>

<?php require 'layout/footer.php' ?>