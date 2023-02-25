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
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h5>List Images </h5>
                            <form action="index.php?controller=image&action=addImgMotel&idMotel=<?php echo $images[0]['motel_id'] ?>" method="post" enctype="multipart/form-data">
                                <div class="d-flex form-group" style="justify-content: center; align-items: center; gap: 10px">
                                    <input type="file" name="images[]" multiple class="form-control" />
                                    <button type="submit" class="btn btn-primary m-0">Add Image</button>
                                </div>
                            </form>
                        </div>

                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Image Name</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($images as $image) : ?>
                                            <tr>
                                                <td>
                                                    <img style="height: 300px;" class="text-xs font-weight-bold mb-0" src="<?php echo $image['image_name'] ?>" />
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="index.php?controller=image&action=deleteImage&idImg=<?php echo $image['id'] ?>" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user">
                                                        <i class="fas fa-trash" style="font-size: 40px;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </main>

</body>