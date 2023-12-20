    
    <?php $html_alert = $alert; ?>
    
    </div>
   </div>

   
    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r79/three.min.js"></script>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.3.0/model-viewer.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../CND/bootstrap.bundle.min.js"></script>

    <script src="Asset/admin.js"></script>
    <script src="Asset/model3d.js"></script>

    
    <!-- Load File Admin Update -->
    <script>
        document.getElementById('imgInput').addEventListener('change', function() {
            const file = this.files[0];
            const imgUrl = URL.createObjectURL(file);
            document.getElementById('imgPreview1').src = imgUrl;
        });

        document.getElementById('img2Input').addEventListener('change', function() {
            const file = this.files[0];
            const imgUrl = URL.createObjectURL(file);
            document.getElementById('imgPreview2').src = imgUrl;
        });
    </script>

    <script>
        function setupImageSelection(inputId, displayId) {
            var selDiv = "";
            var storedFiles = [];
            var selDiv = $(displayId);

            $(document).ready(function () {
                $(inputId).on("change", handleFileSelect);
            });

            function handleFileSelect(e) {
                var files = e.target.files;
                var filesArr = Array.prototype.slice.call(files);
                filesArr.forEach(function (f) {
                if (!f.type.match("image.*")) {
                    return;
                }
                storedFiles.push(f);

                var reader = new FileReader();
                reader.onload = function (e) {
                    var html = '<img src="' + e.target.result + "\" data-file='" + f.name + "' class='img-fluid'>";
                    selDiv.html(html);
                };
                reader.readAsDataURL(f);
                });
            }
            }

            setupImageSelection("#img", "#selectedBanner");
            setupImageSelection("#img2", "#selectedBanner2");
    </script>
    
    <!-- check add  -->
    <script>
        $(document).ready(function() {
            $('button[name="add_product_3d"]').click(function(event) {
                if ($('#name').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng nhập tên sản phẩm!');
                }

                if ($('select[name="id_category"]').val() === 'Chọn danh mục') {
                    event.preventDefault();
                    showErrorToast('Vui lòng chọn danh mục sản phẩm!');
                }

                if ($('input[name="price"]').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng nhập giá gốc!');
                }

                if ($('input[name="sale"]').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng nhập giá khuyến mãi!');
                }

                if ($('input[name="detail"]').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng nhập mô tả sản phẩm!');
                }

                if ($('input[name="glb"]').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng import file 3D!');
                }

                if ($('input[name="img"]').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng import ảnh 1!');
                }

                if ($('input[name="img2"]').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng import ảnh 2!');
                }

                let price = parseFloat($('input[name="price"]').val());
                let sale = parseFloat($('input[name="sale"]').val());
                if (price < sale) {
                    event.preventDefault();
                    showErrorToast('Giá gốc không được lớn hơn giá khuyến mãi!');
                }
            });

            $('button[name="add_product_img"]').click(function(event) {
                if ($('#name_img').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng nhập tên sản phẩm!');
                }

                if ($('select[name="id_category_img"]').val() === 'Chọn danh mục') {
                    event.preventDefault();
                    showErrorToast('Vui lòng chọn danh mục sản phẩm!');
                }

                if ($('input[name="price_img"]').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng nhập giá gốc!');
                }

                if ($('input[name="sale_img"]').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng nhập giá khuyến mãi!');
                }

                if ($('input[name="detail_img"]').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng nhập mô tả sản phẩm!');
                }

                if ($('input[name="img"]').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng import ảnh 1!');
                }

                if ($('input[name="img2"]').val() === '') {
                    event.preventDefault();
                    showErrorToast('Vui lòng import ảnh 2!');
                }

                let price = parseFloat($('input[name="price"]').val());
                let sale = parseFloat($('input[name="sale"]').val());
                if (price < sale) {
                    event.preventDefault();
                    showErrorToast('Giá gốc không được lớn hơn giá khuyến mãi!');
                }
            });
        });
    </script>
    
    <!-- Category/Product -->
    <script>
        $(document).ready(function() {
            $("#category_img,#category_3d").on("click", function() {
                $("#category").show();
                $("#product_imgG").hide();
                $("#product_3dD").hide();
            });

            $("#product_img,#product_3d").on("click", function() {
                $("#category").show();
                $("#product_imgG").show();
                $("#product_3dD").show();
            });

        });
    </script>

<script>
    $(document).ready(function() {
        $("#form2").hide();

        $("button[name='trans']").on("click", function() {
            $("#form2").show();
            $("#form1").hide();
        });

        $("button[name='trans2']").on("click", function() {
            $("#form2").hide();
            $("#form1").show();
        });
    });
</script>


    <!-- alert -->
    <?=$html_alert;?>
    