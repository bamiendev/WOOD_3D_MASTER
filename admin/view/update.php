<?php
    // Show product
    if(is_array($product) && (count($product) > 0)){
        extract($product);
        $id_update = $id;

        $imgpath = IMG_PATH_ADMIN.$img;
        $imgpath2 = IMG_PATH_ADMIN.$img2;
        $glbpath = GLB_PATH_ADMIN.$glb;

        $img = is_file($imgpath) ? '<img id="imgPreview1" src="'.$imgpath.'" class="img-fluid">' : '';
        $img2 = is_file($imgpath2) ? '<img id="imgPreview2" src="'.$imgpath2.'" class="img-fluid">' : '';


        if(is_file($glbpath)){
            $glb  = 
            '<div class="model-container" style="height: 600px;">
                <model-viewer class="model-container" id="modelViewer" src="'.$glbpath.'" camera-controls disable-tap></model-viewer>
            </div>';
        } else{
            $glb = "";
        }

        $html_list_category = show_category_update_admin($list_category,$id_category);
    }
?>

<form id="updateForm" class="addPro" action="indexadmin.php?pg=update" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="text-center mt-3">Cập Nhập Sản Phẩm</h2>
            <input type="hidden" name="id" value="<?=$id_update?>">
            <button type="submit" name="update" id="updateButton" class="btn btn-primary button_update mb-4">Update</button>
        </div>
        
        <div class="col-lg-6">
            <h3 class="text-center" >Thông Tin Sản Phẩm</h3>
            <!-- Img 1 & 2 -->
            <div class="form-group mb-3">
                <h5>Ảnh Sản Phẩm</h5>
                <div class="row">
                    <div class="col-6">
                        <input type="file" class="form-control" accept=".png" id="imgInput" name="img"/>
                        <?=$img?>
                    </div>

                    <div class="col-6">
                        <input type="file" class="form-control" accept=".png" id="img2Input" name="img2"/>
                        <?=$img2?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name" style="font-weight: 700; font-size: 20px;margin-bottom: 20px;">Tên sản phẩm:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?=$name?>">
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="categories" style="font-weight: 700; font-size: 20px; margin-top: 20px; margin-bottom: 20px;">Danh mục:</label>
                <select class="form-select" name="id_category" aria-label="Default select example">
                    <option selected>Chọn danh mục</option>
                    <?=$html_list_category;?>
                </select>
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="price" style="font-weight: 700; font-size: 20px; margin-top: 20px; margin-bottom: 20px;">Giá gốc</label>
                <div class="input-group mb-3">
                    <input type="text" name="price" class="form-control" value="<?=($price>0)?$price:0;?>">
                    <div class="input-group-append">
                        <span class="input-group-text">VNĐ</span>
                    </div>
                </div>
            </div>

            <!-- Sale -->
            <div class="form-group">
                <label for="price" style="font-weight: 700; font-size: 20px; margin-top: 20px; margin-bottom: 20px;">Giá khuyến mãi</label>
                <div class="input-group mb-3">
                    <input type="text" name="sale" class="form-control" value="<?=($sale>0)?$sale:0;?>">
                    <div class="input-group-append">
                        <span class="input-group-text">VNĐ</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label style="font-weight: 700; font-size: 20px; margin-top: 20px;margin-bottom: 20px;">Lượt Xem</label>
                <input type="text" name="view" class="form-control" placeholder="Nhập mô tả về sản phẩm" value="<?=$view?>"></input>
            </div>

            <!-- Detail -->
            <div class="form-group">
                <label style="font-weight: 700; font-size: 20px; margin-top: 20px;margin-bottom: 20px;">Mô tả chi tiết</label>
                <input type="text" name="detail" class="form-control" placeholder="Nhập mô tả về sản phẩm" value="<?=$detail?>"></input>
            </div>

            <!-- Option -->
            <div class="row mb-3">
                <h2 class="text-center" >Các Nút</h2>
                <!-- Type 0-->
                <div class="col-6 col-md-6 col-lg-3 mt-2">
                    <h5 class="mt-2">Type 0</h5>
                    <div  id="input_materials_update1">
                        <!-- Checkbox cho Loại 1 sẽ được thêm vào đây -->
                    </div>
                </div>

                <!-- Type 1 -->
                <div class="col-6 col-md-6 col-lg-3 mt-2">
                    <h5 class="mt-2">Type 1</h5>
                    <div  id="input_materials_update2">
                        <!-- Checkbox cho Loại 1 sẽ được thêm vào đây -->
                    </div>
                </div>

                <!-- Type 2 -->
                <div class="col-6 col-md-6 col-lg-3 mt-2">
                    <h5 class="mt-2">Type 2</h5>
                    <div  id="input_materials_update3">
                        <!-- Checkbox cho Loại 1 sẽ được thêm vào đây -->
                    </div>
                </div>

                <div class="col-6 col-md-6 col-lg-3 mt-2">
                    <h5 class="mt-2">Type 3</h5>
                    <div  id="input_materials_update4">
                        <!-- Checkbox cho Loại 1 sẽ được thêm vào đây -->
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6">
            <div class="form-group">
                <div class="row mb-3 mt-2">
                    <h3 class="text-center">Tùy Chọn</h3>

                    <div class="col-12">
                        <div class="form-group">
                            <h5>File glb</h5>
                            <input type="file" class="form-control" accept=".glb" id="glbInput" name="glb"/>
                            <?=$glb;?>
                        </div>
                    </div>

                    <!-- Type 1 -->
                    <div class="col-12">
                        <div class="row">
                            
                        </div>

                        <?php
                            echo !empty($options_name_1) ? 
                            '<div class="row mt-3">
                                <div class="col-6"><h5 class="mt-2">Type 1</h5></div>
                                <div class="col-3"><p>1: Hết Hàng</p></div>
                            </div>' : '';

                            if (!empty($options_name_1)) {
                                $colors_array = explode(",", $options_name_1);
                                $options_price1 = explode(",", $options_price1);

                                $colors_count = count($colors_array);
                                $limit = $colors_count;

                                foreach (array_slice($colors_array, 0, $limit) as $index => $color) {
                                    $price1 = isset($options_price1[$index]) ? $options_price1[$index] : '';
                                    ?>
                                    <div class="row my-3">
                                        <div class="col-6">
                                            <input type="text" placeholder="Nhập tên options" class="form-control" value="<?=$color?>" readonly>
                                        </div>

                                        <div class="col-6">
                                            <input type="text" name="price_option1[]" placeholder="Nhập giá options" class="form-control" value="<?=$price1?>">
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    
                    <!-- Type 2 -->
                    <div class="col-12">
                        <?php
                            echo !empty($options_name_2) ? '<h5 class="mt-2">Type 2</h5>' : '';

                            if (!empty($options_name_2)) {
                                $colors_array2 = explode(",", $options_name_2);
                                $options_price2 = explode(",", $options_price2); 

                                $colors_count = count($colors_array2);
                                $limit = $colors_count;

                                foreach (array_slice($colors_array2, 0, $limit) as $index => $color2) {
                                    $price2 = isset($options_price2[$index]) ? $options_price2[$index] : '';
                                    ?>
                                    <div class="row my-3">
                                        <div class="col-6">
                                            <input type="text" placeholder="Nhập tên options" class="form-control" value="<?=$color2?>" readonly>
                                        </div>

                                        <div class="col-6">
                                            <input type="text" name="price_option2[]" placeholder="Nhập giá options" class="form-control" value="<?=$price2?>">
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>

                    <!-- Type 3 -->
                    <div class="col-12">
                        <?php
                            echo !empty($options_name_3) ? '<h5 class="mt-2">Type 3</h5>' : '';

                            if (!empty($options_name_3)) {
                                $colors_array3 = explode(",", $options_name_3);
                                $options_price3 = explode(",", $options_price3); 

                                $colors_count = count($colors_array3);
                                $limit = $colors_count;

                                foreach (array_slice($colors_array3, 0, $limit) as $index => $color3) {
                                    $price3 = isset($options_price3[$index]) ? $options_price3[$index] : '';
                                    ?>
                                    <div class="row my-3">
                                        <div class="col-6">
                                            <input type="text" placeholder="Nhập tên options" class="form-control" value="<?=$color3?>" readonly>
                                        </div>

                                        <div class="col-6">
                                            <input type="text" name="price_option3[]" placeholder="Nhập giá options" class="form-control" value="<?=$price3?>">
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('updateForm');
        const imgOption1Fields = form.querySelectorAll('input[name="img_option1[]"]');
        const imgOption2Fields = form.querySelectorAll('input[name="img_option2[]"]');
        const updateButton = form.querySelector('button[name="update"]');

        form.addEventListener('submit', function (event) {
            let isOption1Filled = false;
            let isOption2Filled = false;
            let shouldBlockUpdate = false;

            imgOption1Fields.forEach(function (input) {
                if (input.value.trim() !== '') {
                    isOption1Filled = true;
                }
            });

            imgOption2Fields.forEach(function (input) {
                if (input.value.trim() !== '') {
                    isOption2Filled = true;
                }
            });

            if ((isOption1Filled && !isOption2Filled) || (!isOption1Filled && isOption2Filled)) {
                shouldBlockUpdate = true;
                if (imgOption2Fields || !imgOption2Fields) {
                    shouldBlockUpdate = false;
                }
            }

            

            if (shouldBlockUpdate) {
                event.preventDefault();
                alert("Chọn Thiếu Ảnh Của Tùy Chọn");
            }
        });
    });


    modelViewer.addEventListener('load', () => {
        const reader = new FileReader();

        reader.onload = function (e) {
            const newSrc = e.target.result;
            const modelViewer = document.getElementById('modelViewer');
            modelViewer.src = newSrc;

            modelViewer.addEventListener("load", () => {
                const materials = modelViewer.model.materials;
                selectedCheckboxes = new Set(); // Reset selectedCheckboxes khi có dữ liệu mới
                updateCheckboxesForMaterials(materials);

                function checkUpdate(materials) {
                    const checkboxes = document.querySelectorAll('#input_materials_update1 input[type="checkbox"]');
                    const knownMaterialsString2 = <?= json_encode($options_name);?>;
                    const knownMaterials2 = knownMaterialsString2.split(',');

                    checkboxes.forEach((checkbox) => {
                        if (knownMaterials2.includes(checkbox.value)) {
                            checkbox.checked = true;
                        }
                    });
                }

                function checkUpdate1(materials) {
                    const checkboxes = document.querySelectorAll('#input_materials_update2 input[type="checkbox"]');
                    const knownMaterialsString2 = <?= json_encode($options_name_1);?>;
                    const knownMaterials2 = knownMaterialsString2.split(',');

                    checkboxes.forEach((checkbox) => {
                        if (knownMaterials2.includes(checkbox.value)) {
                            checkbox.checked = true;
                        }
                    });
                }

                function checkUpdate2(materials) {
                    const checkboxes = document.querySelectorAll('#input_materials_update3 input[type="checkbox"]');
                    const knownMaterialsString2 = <?= json_encode($options_name_2);?>;
                    const knownMaterials2 = knownMaterialsString2.split(',');

                    checkboxes.forEach((checkbox) => {
                        if (knownMaterials2.includes(checkbox.value)) {
                            checkbox.checked = true;
                        }
                    });
                }

                function checkUpdate3(materials) {
                    const checkboxes = document.querySelectorAll('#input_materials_update4 input[type="checkbox"]');
                    const knownMaterialsString2 = <?= json_encode($options_name_3);?>;
                    const knownMaterials2 = knownMaterialsString2.split(',');

                    checkboxes.forEach((checkbox) => {
                        if (knownMaterials2.includes(checkbox.value)) {
                            checkbox.checked = true;
                        }
                    });
                }

                checkUpdate(materials);
                checkUpdate1(materials);
                checkUpdate2(materials);
                checkUpdate3(materials);
            });
        };
        reader.readAsDataURL(file);
    });


    let selectedCheckboxes = new Set();
    document.getElementById('glbInput').addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const newSrc = e.target.result;
                const modelViewer = document.getElementById('modelViewer');
                modelViewer.src = newSrc;

                modelViewer.addEventListener("load", () => {
                    const materials = modelViewer.model.materials;
                    selectedCheckboxes = new Set(); // Reset selectedCheckboxes khi có dữ liệu mới
                    updateCheckboxesForMaterials(materials);

                    function checkUpdate(materials) {
                        const checkboxes = document.querySelectorAll('#input_materials_update1 input[type="checkbox"]');
                        const knownMaterialsString2 = <?= json_encode($options_name);?>;
                        const knownMaterials2 = knownMaterialsString2.split(',');

                        checkboxes.forEach((checkbox) => {
                            if (knownMaterials2.includes(checkbox.value)) {
                                checkbox.checked = true;
                            }
                        });
                    }

                    function checkUpdate1(materials) {
                        const checkboxes = document.querySelectorAll('#input_materials_update2 input[type="checkbox"]');
                        const knownMaterialsString2 = <?= json_encode($options_name_1);?>;
                        const knownMaterials2 = knownMaterialsString2.split(',');

                        checkboxes.forEach((checkbox) => {
                            if (knownMaterials2.includes(checkbox.value)) {
                                checkbox.checked = true;
                            }
                        });
                    }

                    function checkUpdate2(materials) {
                        const checkboxes = document.querySelectorAll('#input_materials_update3 input[type="checkbox"]');
                        const knownMaterialsString2 = <?= json_encode($options_name_2);?>;
                        const knownMaterials2 = knownMaterialsString2.split(',');

                        checkboxes.forEach((checkbox) => {
                            if (knownMaterials2.includes(checkbox.value)) {
                                checkbox.checked = true;
                            }
                        });
                    }

                    function checkUpdate3(materials) {
                        const checkboxes = document.querySelectorAll('#input_materials_update4 input[type="checkbox"]');
                        const knownMaterialsString2 = <?= json_encode($options_name_3);?>;
                        const knownMaterials2 = knownMaterialsString2.split(',');

                        checkboxes.forEach((checkbox) => {
                            if (knownMaterials2.includes(checkbox.value)) {
                                checkbox.checked = true;
                            }
                        });
                    }

                    checkUpdate(materials);
                    checkUpdate1(materials);
                    checkUpdate2(materials);
                    checkUpdate3(materials);
                });
            };
            reader.readAsDataURL(file);
        }
    });


    function createCheckboxes(container, materials, typeIndex) {
        container.innerHTML = '';

        materials.forEach((material) => {
            let materialName = material.name;

            let checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.value = materialName;
            checkbox.name = `type${typeIndex}[]`;
            checkbox.className = "form-check-input";
            checkbox.id = `MaterialCheckbox_${materialName.toLowerCase().replace(/\s+/g, '_')}_${typeIndex}`;

            let label = document.createElement("label");
            label.innerHTML = materialName;
            label.htmlFor = `MaterialCheckbox_${materialName.toLowerCase().replace(/\s+/g, '_')}_${typeIndex}`;

            let divCheck = document.createElement("div");
            divCheck.className = "form-check";
            divCheck.appendChild(checkbox);
            divCheck.appendChild(label);

            checkbox.addEventListener('click', () => {
                if (checkbox.checked) {
                    selectedCheckboxes.forEach((selectedCheckbox) => {
                        if (selectedCheckbox.value === checkbox.value && selectedCheckbox !== checkbox) {
                            selectedCheckbox.checked = false;
                            selectedCheckboxes.delete(selectedCheckbox);
                        }
                    });
                    selectedCheckboxes.add(checkbox);
                } else {
                    selectedCheckboxes.delete(checkbox);
                }
            });

            container.appendChild(divCheck);
        });
    }

    function updateCheckboxesForMaterials(materials) {
        for (let i = 0; i <= 4; i++) {
            let containerId = `input_materials_update${i}`;
            let container = document.getElementById(containerId);

            if (container) {
                createCheckboxes(container, materials, i);
            }
        }
    }
</script> -->





<script>
    let selectedCheckboxes = new Set();

    // Function to create checkboxes
    function createCheckboxesForMaterialUpdate(containerId, materials, typeIndex) {
        const container = document.getElementById(containerId);

        if (container) {
            container.innerHTML = '';

            materials.forEach((material) => {
                const materialName = material.name;

                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.value = materialName;
                checkbox.name = `type${typeIndex}[]`;
                checkbox.className = "form-check-input";
                checkbox.id = `MaterialCheckbox_${materialName.toLowerCase().replace(/\s+/g, '_')}_${typeIndex}`;

                const label = document.createElement("label");
                label.innerHTML = materialName;
                label.htmlFor = `MaterialCheckbox_${materialName.toLowerCase().replace(/\s+/g, '_')}_${typeIndex}`;

                const divCheck = document.createElement("div");
                divCheck.className = "form-check";
                divCheck.appendChild(checkbox);
                divCheck.appendChild(label);

                checkbox.addEventListener('click', () => {
                    if (checkbox.checked) {
                        selectedCheckboxes.forEach((selectedCheckbox) => {
                            if (selectedCheckbox.value === checkbox.value && selectedCheckbox !== checkbox) {
                                selectedCheckbox.checked = false;
                                selectedCheckboxes.delete(selectedCheckbox);
                            }
                        });
                        selectedCheckboxes.add(checkbox);
                    } else {
                        selectedCheckboxes.delete(checkbox);
                    }
                });

                container.appendChild(divCheck);
            });
        }
    }

    // Function to update checkboxes for materials
    function updateCheckboxesForMaterials(materials) {
        for (let i = 1; i <= 4; i++) {
            const containerId = `input_materials_update${i}`;
            createCheckboxesForMaterialUpdate(containerId, materials, i);
        }
    }

    document.getElementById('glbInput').addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const newSrc = e.target.result;
                const modelViewer = document.getElementById('modelViewer');
                modelViewer.src = newSrc;

                modelViewer.addEventListener("load", () => {
                    const materials = modelViewer.model.materials;
                    selectedCheckboxes = new Set();
                    handleModelViewerLoad(materials);
                });
            };
            reader.readAsDataURL(file);
        }
    });

    function handleModelViewerLoad(materials) {
        selectedCheckboxes = new Set();
        updateCheckboxesForMaterials(materials);

        function checkUpdate(materials) {
            const checkboxes = document.querySelectorAll('#input_materials_update1 input[type="checkbox"]');
            const knownMaterialsString2 = <?= json_encode($options_name);?>;
            const knownMaterials2 = knownMaterialsString2.split(',');

            checkboxes.forEach((checkbox) => {
                if (knownMaterials2.includes(checkbox.value)) {
                    checkbox.checked = true;
                }
            });
        }

        function checkUpdate1(materials) {
            const checkboxes = document.querySelectorAll('#input_materials_update2 input[type="checkbox"]');
            const knownMaterialsString2 = <?= json_encode($options_name_1);?>;
            const knownMaterials2 = knownMaterialsString2.split(',');

            checkboxes.forEach((checkbox) => {
                if (knownMaterials2.includes(checkbox.value)) {
                    checkbox.checked = true;
                }
            });
        }

        function checkUpdate2(materials) {
            const checkboxes = document.querySelectorAll('#input_materials_update3 input[type="checkbox"]');
            const knownMaterialsString2 = <?= json_encode($options_name_2);?>;
            const knownMaterials2 = knownMaterialsString2.split(',');

            checkboxes.forEach((checkbox) => {
                if (knownMaterials2.includes(checkbox.value)) {
                    checkbox.checked = true;
                }
            });
        }

        function checkUpdate3(materials) {
            const checkboxes = document.querySelectorAll('#input_materials_update4 input[type="checkbox"]');
            const knownMaterialsString2 = <?= json_encode($options_name_3);?>;
            const knownMaterials2 = knownMaterialsString2.split(',');

            checkboxes.forEach((checkbox) => {
                if (knownMaterials2.includes(checkbox.value)) {
                    checkbox.checked = true;
                }
            });
        }

        checkUpdate(materials);
        checkUpdate1(materials);
        checkUpdate2(materials);
        checkUpdate3(materials);
    }

    modelViewer.addEventListener('load', () => {
        const materials = modelViewer.model.materials;
        handleModelViewerLoad(materials);
    });
    </script>