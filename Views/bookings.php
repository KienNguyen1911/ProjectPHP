<?php
require 'layout/header.php';
require 'Views/admin/layout_admin/header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<body>

    <div class="hero hero-inner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mx-auto text-center">
                    <div class="intro-wrap">
                        <h1 class="mb-0">Your Bookings</h1>
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
                <?php foreach ($bookings as $key => $booking) : $image = $images->getOneImage($booking['motel_id']); ?>

                    <div class="col-lg-3 col-md-4 col-sm-1">
                        <div class="card my-2" style="height: 400px;">
                            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                <a href="index.php?controller=motel&action=motelDetail&id=<?php echo $booking['id'] ?>" class="d-block">
                                    <img src="<?php echo $image['image_name']; ?>" class="img-fluid border-radius-lg">
                                </a>
                            </div>

                            <div class="card-body pt-2 d-flex" style="flex-direction: column; justify-content: space-evenly;">
                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                    <?php echo $booking['province_name'] ?>
                                </span>
                                <a href="index.php?controller=motel&action=motelDetail&id=<?php echo $booking['id'] ?>" class="card-title h5 d-block text-darker">
                                    <?php echo $booking['name'] ?>
                                </a>
                                <div class="author align-items-center">
                                    <div class="name">
                                        <span>Price: $
                                            <?php echo $booking['price'] ?>/night
                                        </span>
                                        <div class="name d-flex">
                                            <span class="font-weight-bold text-gradient text-info"><?php echo $booking['start'] ?>
                                                <i class="fa-solid fa-arrow-right"></i> 
                                                <span class="font-weight-bold text-gradient text-info"><?php echo ' '.$booking['end'] ?></span>
                                            </span>
                                        </div>
                                        <div class="stats">
                                            <small>Posted by <?php $user = $users->find($booking['owner_id']);
                                                                echo $user['username'] ?></small>
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