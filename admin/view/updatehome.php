

<!-- Users -->
<div class="row">
    <main>
        <div class="header">
            <div class="left">
                <h1>Image</h1>
            </div>

            <nav>
                <a href="#" class="notif"> <i class='bx bx-bell'></i><span class="count">12</span></a>
            </nav>
        </div>
    </main>
</div>

<main>
    <div class="bottom-data">
        <form action="indexadmin.php?pg=updatehome" method="post" enctype="multipart/form-data">
            <div class="orders">
                <div class="header mb-3">
                    <h3>Hình Ảnh</h3>
                </div>

                <div class="row my-3">
                    <h3 class="text-center mb-3">Trang Chủ</h3>
                    <div class="col-lg-4">
                        <h5>Trang Chủ 1</h5>
                        <input type="file" class="form-control" name="home1"/>
                    </div>
                    <div class="col-lg-4">
                        <h5>Trang Chủ 2</h5>
                        <input type="file" class="form-control" name="home2"/>
                    </div>
                    <div class="col-lg-4">
                        <h5>Trang Chủ 3</h5>
                        <input type="file" class="form-control" name="home3"/>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-6">
                        <h3 class="text-center mt-3 mb-3">Brand</h3>
                        <input type="file" name="brand1[]" placeholder="Thêm ảnh" class="form-control" multiple accept="image/*">
                    </div>

                    <div class="col-6">
                        <h3 class="text-center mt-3 mb-3">Deal Of Week</h3>
                        <input type="file" class="form-control" name="deal1"/>
                    </div>
                </div>

                <div class="row my-3">
                    <h3 class="text-center mt-3 mb-3">Login</h3>
                    <div class="col-lg-4">
                        <h5>Login 1</h5>
                        <input type="file" class="form-control" name="login1"/>
                    </div>
                    <div class="col-lg-4">
                        <h5>Login 2</h5>
                        <input type="file" class="form-control" name="login2"/>
                    </div>
                    <div class="col-lg-4">
                        <h5>Login 3</h5>
                        <input type="file" class="form-control" name="login3"/>
                    </div>
                </div>

                <button type="submit" name="update_home" class="btn btn-primary button_update mb-4">Update</button>
            </div>
        </form>
    </div>
</main>