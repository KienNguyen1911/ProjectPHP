<body class="g-sidenav-show  bg-gray-100">
    <?php require 'Views/admin/layout_admin/aside.php'; ?>

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <!-- Navbar -->
        <?php require 'Views/admin/layout_admin/navbar.php'; ?>
        <!-- End Navbar -->

        <div class="container-fluid py-4">

            <div class="row">
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Add new motel </h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <form method="post" action="index.php?controller=motel&action=add" style="padding: 10px 20px 0px;">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name Attribute</label>
                                    <input class="form-control" type="text" name="attribute_name"  id="example-text-input" placeholder="ex: Air-Conditioner">
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name Attribute</label>
                                    <input class="form-control" type="text" name="attribute_name"  id="example-text-input" placeholder="ex: Air-Conditioner">
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name Attribute</label>
                                    <input class="form-control" type="text" name="attribute_name"  id="example-text-input" placeholder="ex: Air-Conditioner">
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name Attribute</label>
                                    <input class="form-control" type="text" name="attribute_name"  id="example-text-input" placeholder="ex: Air-Conditioner">
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name Attribute</label>
                                    <input class="form-control" type="text" name="attribute_name"  id="example-text-input" placeholder="ex: Air-Conditioner">
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Name Attribute</label>
                                    <input class="form-control" type="text" name="attribute_name"  id="example-text-input" placeholder="ex: Air-Conditioner">
                                </div>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>


</body>