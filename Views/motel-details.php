<?php require 'layout/header.php' ?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
                            <div class="services">
                                <h5>Owner: <?php $user = $users->find($motels[0]['owner_id']);
                                            echo $user['username'] ?></h5>
                                <h5>Contact: <?php echo $user['phonenumber'] ?></h5>
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
                            <form action="index.php?controller=booking&action=create&id=<?php echo $motels[0]['id'] ?>" method="post">

                                <div class="my-3">
                                    <h4>Day In</h4>
                                    <input type="text" class="daterange form-control" name="start">
                                </div>
                                <div class="my-3">
                                    <h4>Day Out</h4>
                                    <input type="text" class="daterange form-control" name="end">
                                </div>
                                <input type="submit" class="btn btn-primary btn-block" value="Search">

                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $(".daterange").daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: "Clear",
                },
                minDate: moment().subtract(0, "days"),

                isInvalidDate: function(date) {
                    // create a variable to hold the date
                    var paymentDate = <?php echo json_encode($orders); ?>;
                    // for loop to check if the date is in the array
                    for (var i = 0; i < paymentDate.length; i++) {
                        // if the date is in the array return true
                        for (var m = moment(paymentDate[i].start); m.isBefore(paymentDate[i].end) ; m.add(1, "days")) {
                            if (date.format('YYYY-M-D') == m.format('YYYY-M-D')) {
                                return true;
                            }
                        }
                    }
                }
            });

            $(".daterange").on("apply.daterangepicker", function(ev, picker) {
                $('input[name="start"]').val(picker.startDate.format("YYYY-MM-DD"));
                $('input[name="end"]').val(picker.endDate.format("YYYY-MM-DD"));
            });

            $('input[name="start"], input[name="end"] ').on(
                "cancel.daterangepicker",
                function(ev, picker) {
                    $(this).val("");
                }
            );

        });
    </script>
    <?php require 'layout/footer.php' ?>
</body>