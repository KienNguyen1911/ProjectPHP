<?php require 'layout/header.php' ?>

<body>
    <div class="hero hero-inner" style="padding: 0 0 5rem 0; ">
        <div class="container">
            <div class="row align-items-center">
            </div>
        </div>
    </div>

    <div class="untree_co-section">
        <div class="container my-1">
            <div class="mb-5">
                <div class="owl-single dots-absolute owl-carousel">
                    <?php foreach ($images as $image) : ?>
                        <img src="<?php echo $image['image_name'] ?>" alt="Free HTML Template by Untree.co" class="img-fluid" style="height: 600px;">
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <div class="card">

                        <div class="card-header">
                            <h2 class="section-title">
                                <?php echo $motels[0]['name'] ?>
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="price ml-auto">
                                <h5>Price: $<?php echo $motels[0]['price'] ?>/night</h5>
                            </div>
                            <h5>Address: <?php echo $motels[0]['province_name'] . ", " . $motels[0]['district_name'] . ", " . $motels[0]['ward_name'] ?></h5>
                            <p class="description">
                                <?php echo $motels[0]['description'] ?>
                            </p>
                            <div class="services">
                                <h5>Services</h5>
                                <ul>
                                    <?php foreach ($attrMotel as $value) : ?>
                                        <li><?php $a = $attribute->find($value);
                                            echo $a['attribute_name'] ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-5">
                    <div class="card">

                        <div class="card-header">
                            <h2 class="section-title">
                                Check-In & Check-Out
                            </h2>
                        </div>

                        <div class="card-body">
                            <div class="my-3">
                                <input type="text" class="form-control" name="daterange">
                            </div>
                            <input type="submit" class="btn btn-primary btn-block" value="Search">

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'layout/footer.php' ?>
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>
</body>