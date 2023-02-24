<?php require 'layout/header.php' ?>

<body>

    <div class="hero hero-inner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mx-auto text-center">
                    <div class="intro-wrap">
                        <h1 class="mb-0">Booking Details</h1>
                        <p class="text-white">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                <div class="custom-block" data-aos="fade-up">

                    <h2 class="section-title text-center" style="display: block;">Gallery</h2>
                    <div class="row gutter-v2 gallery">
                        <?php foreach ($images as $image) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <a href="<?php echo $image['image_name'] ?>" class="gal-item" data-fancybox="gal" style="height: 250px; object-fit: cover; overflow: hidden;">
                                    <img src="<?php echo $image['image_name'] ?>" alt="Image" class="img-fluid">
                                </a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="untree_co-section" style="padding-top: 0px;" >
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <form class="contact-form" data-aos="fade-up" data-aos-delay="200" method="post" 
                        action="index.php?controller=order&action=create&idBooking=<?php echo $_GET['id']?>">

                        <div class="form-group">
                            <label class="text-black" for="email">Name Home</label>
                            <input type="text" class="form-control" id="email" value="<?php echo $booking[0]['name'] ?>" readonly>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-black" for="fname">Check In</label>
                                    <input type="text" class="form-control" id="fname" value="<?php echo $booking[0]['start'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-black" for="lname">Check Out</label>
                                    <input type="text" class="form-control" id="lname" value="<?php echo $booking[0]['end'] ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-black" for="message">Price/night</label>
                                    <input name="" class="form-control" id="message" cols="30" rows="5" value="<?php echo "$" . $booking[0]['price'] ?>" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="text-black" for="message">Number of night</label>
                                    <input name="" class="form-control" id="message" cols="30" rows="5" 
                                    value="<?php echo $days = round(abs(strtotime($booking[0]['end']) - strtotime($booking[0]['start'])) / 86400) ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="text-black" for="message">Total Moneyyy</label>
                            <input name="total" class="form-control" id="message" cols="30" rows="5" value="<?php echo $booking[0]['price'] * $days ?>" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Order</button>

                    </form>
                </div>

                <div class="col-lg-5 ml-auto">
                    <div class="quick-contact-item d-flex align-items-center mb-4">
                        <span class="flaticon-house"></span>
                        <address class="text">
                            <?php echo $booking[0]['ward_name'] . ", " . $booking[0]['district_name'] . ", " . $booking[0]['province_name'] ?>
                        </address>
                    </div>
                    <div class="quick-contact-item d-flex align-items-center mb-4">
                        <span class="flaticon-phone-call"></span>
                        <address class="text">
                            <?php echo $owners['phonenumber'] ?>
                        </address>
                    </div>
                    <div class="quick-contact-item d-flex align-items-center mb-4">
                        <span class="flaticon-mail"></span>
                        <address class="text">
                            <?php echo $owners['email'] ?>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<?php require 'layout/footer.php' ?>