<body class="g-sidenav-show  bg-gray-100">
    <?php require 'Views/admin/layout_admin/aside.php'; ?>

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <!-- Navbar -->
        <?php require 'Views/admin/layout_admin/navbar.php'; ?>
        <!-- End Navbar -->

        <div class="container-fluid py-4">

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Add new motel </h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <form method="post" action="index.php?controller=motel&action=add"
                                style="padding: 10px 20px 0px;">
                                <div class="row">
                                    <div class="col-8">

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="example-text-input" class="form-control-label">Name
                                                        Motel</label>
                                                    <input class="form-control" type="text" name="attribute_name"
                                                        id="example-text-input" placeholder="ex: Air-Conditioner">
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Price</label>
                                                    <input class="form-control" type="text" name="attribute_name"
                                                        id="example-text-input" placeholder="ex: Air-Conditioner">
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Status</label>
                                                    <input class="form-control" type="text" name="attribute_name"
                                                        id="example-text-input" placeholder="ex: Air-Conditioner">
                                                </div>

                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="example-text-input"
                                                        class="form-control-label">Area</label>
                                                    <input class="form-control" type="text" name="attribute_name"
                                                        id="example-text-input" placeholder="ex: Air-Conditioner">
                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Example select</label>
                                            <select class="form-control" id="province">
                                                <option value="" selected disabled>Choose province</option>
                                                <?php foreach ($provinces as $province): ?>
                                                    <option value="<?php echo $province['id'] ?>">
                                                        <?php echo $province['name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Example select</label>
                                            <select class="form-control" id="district">
                                                <option selected disabled>Choose District</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Example select</label>
                                            <select class="form-control" id="ward">
                                                <option selected disabled>Choose Ward</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Name
                                                Attribute</label>
                                            <textarea class="form-control" type="text" name="attribute_name"
                                                id="example-text-input" placeholder="ex: Air-Conditioner"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <?php foreach ($attributes as $attribute) : ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1"
                                                checked="">
                                            <label class="custom-control-label" for="customCheck1">
                                                <?php echo $attribute['attribute_name'] ?>
                                            </label>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#province').on('change', function () {
                var provinceID = $(this).val();
                if (provinceID) {
                    $.ajax({
                        type: 'POST',
                        url: 'http://localhost/ProjectPHP/index.php?controller=address&action=getDistricts',
                        data: 'id=' + provinceID,
                        success: function (data) {
                            console.log(data);
                            $('#district').html(data);
                            $.each(data, function (key, value) {
                                $('select[name="id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
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
                if (districtID) {
                    $.ajax({
                        type: 'POST',
                        url: 'ajaxData.php',
                        data: 'id=' + districtID,
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