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

    <div class="untree_co-section " style="padding-bottom: 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="index.php?controller=motel&action=searchMotels">
                        <div class="row">

                            <div class="col-lg-5">
                                <div class="form-group">
                                    <input type="text" name="motelName" class="form-control" id="text" placeholder="Motel Name">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <select name="province" id="province" class="form-control custom-select">
                                    <option value="">Destination</option>
                                    <?php foreach ($provinces as $province): ?>
                                        <option value="<?php echo $province['id'] ?>">
                                            <?php echo $province['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-lg-3">
                                <select name="district" id="district" class="form-control custom-select">
                                    <option value="">Destination</option>
                                    <option value="">Choose this</option>
                                </select>
                            </div>

                            <div class="col-lg-1">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="untree_co-section" style="padding-top: 0px;">
        <div class="container">
            <div class="row">

                <?php foreach ($motels as $motel):
                    $imageMotel = $this->motelImage($motel); ?>

                    <div class="col-lg-3 col-md-4 col-sm-1">
                        <div class="card my-2" style="height: 370px;">
                            <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                <a href="index.php?controller=motel&action=motelDetail&id=<?php echo $motel['id'] ?>"
                                    class="d-block">
                                    <img src="<?php echo $imageMotel['image_name'] ?>" class="img-fluid border-radius-lg">
                                </a>
                            </div>

                            <div class="card-body pt-2 d-flex"
                                style="flex-direction: column; justify-content: space-evenly;">
                                <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">
                                    <?php
                                    echo $motel['province_name'] ?>
                                </span>
                                <a href="index.php?controller=motel&action=motelDetail&id=<?php echo $motel['id'] ?>"
                                    class="card-title h5 d-block text-darker">
                                    <?php echo $motel['name'] ?>
                                </a>
                                <div class="author align-items-center">
                                    <div class="name">
                                        <span>Price: $
                                            <?php echo $motel['price'] ?>/night
                                        </span>
                                        <div class="stats">
                                            <small>Posted on
                                                <?php $user = $users->find($motel['owner_id']);
                                                echo $user['username'] ?>
                                            </small>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#province').on('change', function () {
                var provinceID = $(this).val();
                console.log(provinceID);
                if (provinceID) {
                    $.ajax({
                        type: 'POST',
                        data: {
                            province: provinceID,
                        },
                        url: 'index.php?controller=address&action=districts',
                        success: function (data) {
                            $('#district').html(data);
                            $('#ward').html('<option value="">Select state first</option>');
                        }
                    });
                } else {
                    $('#district').html('<option value="">Select country first</option>');
                    $('#ward').html('<option value="">Select state first</option>');
                }
            });

            $('#district').on('change', function () {
                var districtID = $(this).val();
                console.log(districtID);
                if (districtID) {
                    $.ajax({
                        type: 'POST',
                        url: 'index.php?controller=address&action=wards',
                        data: {
                            district: districtID,
                        },
                        success: function (html) {
                            $('#ward').html(html);
                        }
                    });
                } else {
                    $('#ward').html('<option value="">Select state first</option>');
                }
            });
        });
    </script>
</body>

<?php require 'layout/footer.php' ?>