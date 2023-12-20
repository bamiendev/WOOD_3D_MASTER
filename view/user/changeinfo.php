            <div class="col-lg-9">
                <div class="row text-center">
                    <div class="col-12 mb-2">
                        <label for="inputEmail4" class="form-label">Name</label>
                        <input type="email" class="form-control text-center" id="inputEmail4" value="<?=$_SESSION['name_user']?>">
                    </div>

                    <div class="col-lg-6 mb-2">
                        <label for="inputEmail4" class="form-label">Email</label>
                        <input type="email" class="form-control text-center" id="inputEmail4" value="<?=$_SESSION['email_user']?>">
                    </div>

                    <div class="col-lg-6 mb-2 ">
                        <label for="inputEmail4" class="form-label">Number Phone</label>
                        <input type="email" class="form-control text-center" id="inputEmail4">
                    </div>

                    <div class="col-12 mt-2">
                        <label for="inputEmail4" class="form-label">Address</label>
                    </div>

                    <div class="col-sm-4 mt-2">
                        <select name="111" id="province" class="select-club-services"></select>
                    </div>

                    <div class="col-sm-4 mt-2">
                        <select name="222" id="district" class="select-club-services">
                            <option value="" selected>Chọn Quận</option>
                        </select>
                    </div>

                    <div class="col-sm-4 mt-2">
                        <select name="" id="ward" class="select-club-services">
                            <option value="" selected>Chọn Phường</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>