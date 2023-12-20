
<?php $html_alert = $alert?>

<!-- Back to Top -->
<div class = "container">
    <div id="myBtn">
        <button class="myBtn" onclick="topFunction()">
            <svg class="svgIcon" viewBox="0 0 384 512">
                <path
                    d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z">
                </path>
            </svg>
        </button>
    </div>
</div>

<script>
    function printInvoice(){
        window.print();
    }
</script>

<script>
    function scrollToProduct() {
        // Lấy đối tượng phần tử có ID là "product_all"
        var productAllElement = document.getElementById("product_all");

        // Cuộn trang đến đối tượng phần tử "product_all"
        if (productAllElement) {
            productAllElement.scrollIntoView({ behavior: 'smooth' });
        }
    }

</script>

<!-- Footer -->
<footer class = "footer-section">
    <div class = "container">
        <div class = "row">
            <div class = "col-sm-6 col-lg-4">
                <div class = "footer-left">
                    <div class = "footer-logo">
                        <a href = "index.php">
                            <img src="Asset/img/logo/logo_1.png" height = 40>
                        </a>
                    </div>
                    <ul>
                        <li>Address: Trung Mỹ Tây 4, Q.12, TP.Hồ Chí Minh</li>
                        <li>Phone: +84 (918) 685 740</li>
                        <li>Email: wood3d@gmail.com</li>
                    </ul>
                </div>
            </div>

            <div class = "col-sm-6 col-lg-2">
                <div class = "footer-widget">
                    <h5>Information</h5>
                    <ul>
                        <li><a href = "about.html">About us</a></li>
                        <li><a href = "store.html">Product</a></li>
                        <li><a href = "contact.html">Contact</a></li>
                        <li><a href = "faqs.html">Help & FAQs</a></li>
                    </ul>
                </div>
            </div>

            <div class = "col-sm-6 col-lg-2">
                <div class = "footer-widget">
                    <h5>My Account</h5>
                    <ul>
                        <li><a href = "login.html">Log in</a></li>
                        <li><a href = "register.html">Register</a></li>
                        <li><a href = "index.php?pg=cart">Shopping Cart</a></li>
                        <li><a href = "products1.html">Shop</a></li>
                    </ul>
                </div>
            </div>

            <div class = "col-sm-6 col-lg-4">
                <div class = "newslatter-item">
                    <h5>Viewer 3D</h5>
                    <p>Vietnam's premier website integrating 3D viewing!</p>
                    <div class = "footer-logo">
                        <div class="row mb-3 text-center">
                            <div class="col-2 px-0 mx-auto">
                                <a target="_blank" href = "https://www.autodesk.com"><img src = "Asset/img/logo/maya.png" alt = "" height = 40></a>
                            </div>

                            <div class="col-2 px-0 mx-auto">
                                <a target="_blank" href = "https://www.autodesk.com"><img src = "Asset/img/logo/3ds.png" alt = "" height = 40></a>
                            </div>

                            <div class="col-2 px-0 mx-auto">
                                <a target="_blank" href = "https://www.blender.org"><img src = "Asset/img/logo/blender.png" alt = "" height = 40></a>
                            </div>
                            
                            <div class="col-2 px-0 mx-auto">
                                <a target="_blank" href = "https://sketchfab.com"><img src = "Asset/img/logo/sketchfab.png" alt = "" height = 40></a>
                            </div>

                            <div class="col-2 px-0 mx-auto">
                                <a target="_blank" href = "https://sketchfab.com">
                                    <img src = "Asset/img/logo/zbrush.png" alt = "" height = 40>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->



<!-- Js Plugins -->
<!-- =================== Model Viewer ================= -->
<!-- Model viewer -->
<script>
    function setMaterials(chuoi, radioGroupName, status) {
        if (modelViewer) {
            modelViewer.addEventListener("load", (ev) => {
                let mangMau = chuoi.split(',');
                let materials = modelViewer.model.materials;
                materials.forEach((material) => {
                    if (mangMau.includes(material.name)) {
                        material.setAlphaMode("MASK");
                        material.setAlphaCutoff(0.01);
                    }
                });
            }); 

            modelViewer.addEventListener("load", (ev) => {
                let mangMau = chuoi.split(',');
                const radioButtons = document.querySelectorAll(`input[name="${radioGroupName}"]`);

                mangMau.forEach((materialName) => {
                    const material = modelViewer.model.materials.find(mat => mat.name === materialName);
                    if (material) {
                        material.setAlphaMode("MASK");
                        material.setAlphaCutoff(2);
                    }
                });

                function handleRadioButtonChange(event) {
                    if (event.target.checked) {
                        const selectedMaterialName = event.target.value;

                        mangMau.forEach((materialName) => {
                            const material = modelViewer.model.materials.find(mat => mat.name === materialName);
                            if (material) {
                                if (materialName === selectedMaterialName) {
                                    material.setAlphaMode("MASK");
                                    material.setAlphaCutoff(0.01);
                                } else {
                                    material.setAlphaCutoff(2);
                                }
                            }
                        });
                    }
                }

                radioButtons.forEach((radio) => {
                    radio.addEventListener('change', handleRadioButtonChange);
                });

                function selectRadioButtonByValue(value) {
                    radioButtons.forEach((radio) => {
                        if (radio.value === value) {
                            radio.checked = true;
                            radio.dispatchEvent(new Event('change'));
                        }
                    });
                }

                if(status == 1){
                    if (mangMau.length > 0) {
                        selectRadioButtonByValue(mangMau[0]);
                    }
                }
            });
        }
    }

    setMaterials(<?= json_encode($options_name_1); ?>, 'radio-card1',1);
    setMaterials(<?= json_encode($options_name_2); ?>, 'radio-card2',1);
    setMaterials(<?= json_encode($options_name_3); ?>, 'radio-card3',1);

    function disableRadioWithId(name, id) {
        const radioInputs = document.querySelectorAll(`input[name="${name}"]`);
        
        radioInputs.forEach(input => {
            if (input.id === id) {
                input.disabled = true;
            }
        });
    }

    disableRadioWithId('radio-card1', '1');
    disableRadioWithId('radio-card2', '1');
    disableRadioWithId('radio-card3', '1');
</script>

<script>
    // Lấy tất cả các input radio có name="radio-card_img"
    const radioInputs = document.querySelectorAll('input[name="radio-card_img"]');
    radioInputs.forEach(function(radioInput) {
        if (radioInput.value === '1') {
            radioInput.disabled = true;
        }
    });

</script>
<!-- End Model viewer -->

<!-- Time best -->
<script>
    const updateCountdown = () => {
        const daysElement = document.getElementById('days');
        const hoursElement = document.getElementById('hours');
        const minutesElement = document.getElementById('minutes');
        const secondsElement = document.getElementById('seconds');
        const now = new Date().getTime();
        let futureDate = localStorage.getItem('futureDate');
        if (!futureDate) {
            futureDate = now + (4 * 24 * 60 * 60 * 1000);
            localStorage.setItem('futureDate', futureDate);
        }
        let timeRemaining = futureDate - now;
        if (timeRemaining <= 0) {
            futureDate = now + (4 * 24 * 60 * 60 * 1000);
            localStorage.setItem('futureDate', futureDate);
            timeRemaining = futureDate - now;
        }
        let days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        let hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
        daysElement.textContent = days;
        hoursElement.textContent = hours;
        minutesElement.textContent = minutes;
        secondsElement.textContent = seconds;
    };
    updateCountdown();
    const interval = setInterval(updateCountdown, 1000);
</script>

<!-- Img lazyloadding -->
<script>
    const images = document.querySelectorAll('img[data-src]')
    const imageObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            const { target } = entry; // ES6
            const src = target.getAttribute('data-src')
            if (src && entry.isIntersecting) {
                target.setAttribute('src', src)
                target.style.minHeight = 'auto'
                target.style.opacity = 1
                imageObserver.unobserve(target)
            }
        })
    }, {
        rootMargin: "-150px"
    })

    images.forEach(image => {
        imageObserver.observe(image)
    })
</script>

<!-- =================== End Model Viewer  ================= -->
<script src="Asset/js/animation.js"></script>
<script src="Asset/js/jquery-3.3.1.min.js"></script>
<script src="Asset/js/bootstrap.min.js"></script>
<script src="Asset/js/jquery.dd.min.js"></script>
<!-- <script src="Asset/js/jquery.zoom.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>

<script src="Asset/js/owl.carousel.min.js"></script>
<script src="Asset/js/main.js"></script>
<script src="Asset/js/modelviewer3D.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.3.0/model-viewer.min.js"></script>
<!-- End Js Plugins -->


<!-- Script -->
<!-- ===================Start jquery================= -->
<!-- Button + - -->
<script>
    function wcqib_refresh_quantity_increments() {
        jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function (a, b) {
            var c = jQuery(b);
            c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
        })
    }
    String.prototype.getDecimals || (String.prototype.getDecimals = function () {
        var a = this,
            b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
        return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
    }), jQuery(document).ready(function () {
        wcqib_refresh_quantity_increments()
    }), jQuery(document).on("updated_wc_div", function () {
        wcqib_refresh_quantity_increments()
    }), jQuery(document).on("click", ".plus, .minus", function () {
        var a = jQuery(this).closest(".quantity").find(".qty"),
            b = parseFloat(a.val()),
            c = parseFloat(a.attr("max")),
            d = parseFloat(a.attr("min")),
            e = a.attr("step");
        b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
    });
</script>

<!-- Update price cart -->
<script>
    $(document).ready(function() {
        $(".plus").on("click", function() {
            var productId = $(this).closest(".card-body").find('.input-text.qty').data('id');
            var currentSale = $("#sale_" + productId + " span").text();
            
            var quantity = parseInt($("#quantity_" + productId).val());
            var numericSale = parseInt(currentSale.replace(/\D/g, ''), 10);

            if (!isNaN(numericSale) && !isNaN(quantity)) {
                var newTotal = numericSale * (quantity + 1);
                if (!isNaN(newTotal)) {
                    $("#price_" + productId).text(newTotal.toLocaleString('vi-VN') + ' VNĐ'); // Định dạng lại số và hiển thị
                }
            }
        });


        $(".minus").on("click", function() {
            var productId = $(this).closest(".card-body").find('.input-text.qty').data('id');
            var currentSale = $("#sale_" + productId).text();
            var quantity = parseInt($("#quantity_" + productId).val());

            if (quantity > 1) {
                quantity = quantity;
            } else {
                quantity = 1;
            }

            var numericSale = parseInt(currentSale.replace(/\D/g, ''), 10);
            var newTotal = numericSale * (quantity - 1);

            if (!isNaN(newTotal) && quantity > 1) {
            $("#quantity_" + productId).val(quantity);
            $("#price_" + productId).text(newTotal.toLocaleString('vi-VN') + ' VNĐ');
        }
        });

        $(".input-text.qty").on("input", function() {
            var productId = $(this).data('id');
            var currentSale = $("#sale_" + productId).text();
            var quantity = parseInt($(this).val());

            var numericSale = parseInt(currentSale.replace(/\D/g, ''), 10);
            var newTotal = numericSale * quantity;

            if (!isNaN(newTotal) && quantity > 0) {
                $("#price_" + productId).text(newTotal.toLocaleString('en-US') + ' VNĐ');
            }
        });

        $(".input-text.qty").each(function() {
            var productId = $(this).data('id');
            var currentSale = $("#sale_" + productId).text();
            var quantity = parseInt($(this).val());

            var numericSale = parseInt(currentSale.replace(/\D/g, ''), 10);
            var newTotal = numericSale * quantity;

            if (!isNaN(newTotal) && quantity > 0) {
                $("#price_" + productId).text(newTotal.toLocaleString('en-US') + ' VNĐ');
            }
        });

        $('.sale-price').each(function() {
            var priceText = $(this).find('span').text();
            var price = parseInt(priceText);
            if (!isNaN(price)) {
                var formattedPrice = price.toLocaleString({ style: 'currency', currency: 'VND' });
                $(this).find('span').text(formattedPrice);
            }
        });
    });

</script>

<!-- Update price details -->
<script>
    const initialPriceText = $("#current-price").text();
    const price_ALL = $(".old-price span").text();
    if(initialPriceText == 0){
        $("#current-price span").text("Liên Hệ");
    }else{
        var price_first = parseFloat(initialPriceText.replace('VNĐ', '').trim());
        var price_first2 = parseFloat(price_ALL.replace('VNĐ', '').trim());

        $("#current-price span").text(price_first.toLocaleString() + " VNĐ");
        $(".old-price span").text(price_first2.toLocaleString());
        
        $(document).ready(function() {
            var totalSelectedPrice = 0;

            $('input[name^="radio-card"]').change(function() {
                totalSelectedPrice = 0;

                $('input[name^="radio-card"]').each(function() {
                    if ($(this).is(':checked')) {
                        var selectedPrice = parseFloat($(this).attr('id'));
                        if (!isNaN(selectedPrice) && selectedPrice > 0) {
                            totalSelectedPrice += selectedPrice;
                        }
                    }
                });

                var price_first = parseFloat(initialPriceText.replace('VNĐ', '').trim());
                var totalNewPrice = price_first + totalSelectedPrice;

                if (totalSelectedPrice === 0) {
                    $("#current-price span").text(price_first.toLocaleString() + " VNĐ");
                    $('#additional-price').hide();
                } else {
                    var additionalPriceElement = $('#additional-price');
                    additionalPriceElement.text(`(+ ${totalSelectedPrice.toLocaleString()} VNĐ)`);
                    additionalPriceElement.show();
                    $("#current-price span").text(totalNewPrice.toLocaleString() + " VNĐ");
                }

                // Giá GỐc
                var priceAAA = parseInt(price_ALL) + parseInt(totalSelectedPrice)
                $(".old-price span").text(priceAAA.toLocaleString());
            });
        });
    }
</script>

<!-- Update price checkout -->
<script>
    $(document).ready(function() {
        // Function to calculate total
        function calculateTotal() {
            var totalDiscount = 0;
            $('.coupon4').each(function() {
                var isChecked = $(this).find('.couponcheck').is(':checked');
                var currentDiscount = parseInt($(this).find('p span').text().replace(/\./g, ''), 10);

                if (isChecked) {
                    totalDiscount += currentDiscount;
                }
            });

            var currentSub = parseInt($('.sub h7 span').text().replace(/\./g, ''), 10);
            var currentShip = parseInt($('.ship h7 span').text().replace(/\./g, ''), 10);
            var total = currentSub + currentShip - totalDiscount;

            // Format and update values
            var formattedDiscount = totalDiscount.toLocaleString('vi-VN', {currency: 'VND'});
            var formattedTotal = total.toLocaleString('vi-VN', {currency: 'VND'});
            $('.discount h7 span').text(formattedDiscount);
            $('.total h5 span').text(formattedTotal);
        }
        calculateTotal();
        $('.couponcheck').change(function() {
            calculateTotal();
        });
    });

</script>

<!-- Area Api VN -->
<script>
    const host = "https://provinces.open-api.vn/api/";

    var callAPI = (api, selectId) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data, selectId);
            });
    };

    callAPI('https://provinces.open-api.vn/api/?depth=1', "province");

    var callApiDistrict = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.districts, "district");
            });
    };

    var callApiWard = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.wards, "ward");
            });
    };

    var renderData = (array, select) => {
        let row = ' <option disable value="">Chọn</option>';
        array.forEach(element => {
            row += `<option value="${element.code}">${element.name}</option>`;
        });
        $("#" + select).html(row);
    };

    $("#province").change(() => {
        callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
        printResult();
    });

    $("#district").change(() => {
        callApiWard(host + "d/" + $("#district").val() + "?depth=2");
        printResult();
    });

    $("#ward").change(() => {
        printResult();
    });

    var printResult = () => {
        if ($("#district").val() !== "" && $("#province").val() !== "" &&
            $("#ward").val() !== "") {
            let result = $("#province option:selected").text() +
                " | " + $("#district option:selected").text() + " | " +
                $("#ward option:selected").text();
            $("#result").text(result);
        }
    };

</script>

<!-- Nice select -->
<script>
    $(document).ready(function() {
        $('select').niceSelect();

        var currentURL = window.location.href;
        if (currentURL.includes('index.php?pg=checkout')) {
            $('select').niceSelect('destroy');
        }
    });
</script>
<!-- ===================End jquery================= -->


<!-- =================== Show ================= -->
<!-- Hide/Show Seach bar -->
<script>
    const inputField = document.querySelector('.f_input');
    const resetButton = document.querySelector('.reset');
    const resultBox = document.querySelector('.result-box');
    const colContainer = document.querySelector('.col-lg-6');

    inputField.addEventListener('input', toggleResultBox);
    inputField.addEventListener('focus', toggleResultBox);
    resetButton.addEventListener('click', () => resultBox.style.display = 'none');
    document.addEventListener("DOMContentLoaded", () => document.addEventListener('click', handleClickOutside));

    function toggleResultBox() {
        resultBox.style.display = (inputField.value !== '') ? 'block' : 'none';
    }

    function handleClickOutside(event) {
        if (!colContainer.contains(event.target)) {
            resultBox.style.display = 'none';
        }
    }
</script>

<!-- Hide/Show Category -->
<script>
    function toggleCollapseClass() {
        const collapseElements = document.querySelectorAll('.collapse');
        if (window.innerWidth <= 991) {
            collapseElements.forEach(element => {
                element.classList.remove('show');
                element.classList.add('close');
            });
        } else {
            collapseElements.forEach(element => {
                element.classList.remove('close');
                element.classList.add('show');
            });
        }
    }
    toggleCollapseClass();
    window.addEventListener('resize', toggleCollapseClass);
</script>
<!-- =================== End Show ================= -->


<!-- =================== Live ================= -->
<!-- Live search -->
<script>
    $(document).ready(function () { 
        $("#live_search").keyup(function () { 
            var input = $(this).val();
            // alert(input);
            if(input != ""){

                $.ajax({
                    url:"view/ajax.php",
                    method: "POST",
                    data:{input:input},

                    success:function(data){
                        $("#searchresult").html(data);
                    }
                });
            }else{
                $("#searchresult").css("display","none");
            }
        });
    });
</script>

<!-- Live add cart -->
<script>
    function createNotificationContent(status, product, quantity) {
        return `
        <div class="container">
            <div class="row">
                <div class="noti-image col-4 col-lg-4">
                    <img src="${product.image}" width="90px">
                </div>
                <div class="noti-detail col-6 col-lg-7">
                    <h6>${product.name} has been ${status} your <span><a href="index.php?pg=cart">Cart</a></span>.</h6>
                    <p>Category: ${product.category}</p>
                    <p>Quantity: ${quantity}</p>
                </div>
                <div class="col-2 col-lg-1">
                    <button class="close float-right" onclick="closePopup()"><i class="fa-solid fa-xmark fa-beat-fade"></i></button>
                </div>
            </div>
        </div>`;
    }

    function showPopup(status, product, quantity) {
        let noti = document.querySelector('.notification-toast');
        noti.style.display = "block";

        const notificationContent = createNotificationContent(status, product, quantity);
        noti.innerHTML = notificationContent;

        noti.classList.remove("animate__fadeOutLeft");
        noti.classList.add("animate__fadeInLeft");

        setTimeout(closePopup, 4000);
    }

    function closePopup() {
        let noti = document.querySelector('.notification-toast');
        if (noti.style.display === "block") {
            noti.classList.remove("animate__fadeInLeft");
            noti.classList.add("animate__fadeOutLeft");
        }
    }

    function addToCart(form) {
        var id = form.find('input[name="id"]').val();
        var name = form.find('input[name="name"]').val();
        var img = form.find('input[name="img"]').val();
        var price = form.find('input[name="price"]').val();
        var sale = form.find('input[name="sale"]').val();
        var category = form.find('input[name="category"]').val();
        var type = form.find('input[name="type"]').val();

        const mockProduct = {
            name: name,
            image: `Asset/upload/img/${img}`,
            category: category
        };
        const mockQuantity = 1;

        if(sale != 0){
            showPopup('added to', mockProduct, mockQuantity);
            $.post("view/ajax.php", {
                id_product: id,
                name: name,
                img: img,
                price: price,
                sale: sale,
                type: type
            }, function(result) {
                var cartCount = $('#boxcart a span').text(result);
            });
        } else{
            var newHTML = `<h6>Vui lòng liên hệ để biết thêm thông tin!</h6>`;
            showPopupStatus('Error', newHTML);
        }
    }

    // live search options 3D
    function selectData(data) {
        $.ajax({
            url:"view/ajax.php",
            method: "POST",
            data:{ data: data },

            success:function(result){
                $("#product_list").html(result);

                $('.sideicons-btn[name="add_cart"]').click(function(e) {
                    e.preventDefault();
                    addToCart($(this).closest('form'));
                });
            }
        });
    }
    
    function selectData_img(data) {
        $.ajax({
            url:"view/ajax.php",
            method: "POST",
            data:{ data_img: data},

            success:function(result){
                $("#product_list").html(result);

                $('.sideicons-btn[name="add_cart"]').click(function(e) {
                    e.preventDefault();
                    addToCart($(this).closest('form'));
                });
            }
        });
    }

    // live search Category 3D
    function selectCategory(data_category) {
        $.ajax({
            url:"view/ajax.php",
            method: "POST",
            data: { data_category: data_category },

            success:function(result){
                if(result != ""){
                    $("#product_list").html(result);
                }else if(data_category == "Lọc Theo Danh Mục"){
                    var newHTML = `<h6><i class="fa-light fa-cat fa-2xl"></i> Chưa chọn danh mục!</h6>`;
                    showPopupStatus('Error', newHTML);
                }
                else{
                    var newHTML = `<h6><i class="fa-light fa-cat fa-2xl"></i> Chưa có sản phẩm trong danh mục này!</h6>`;
                    showPopupStatus('Error', newHTML);
                }

                $('.sideicons-btn[name="add_cart"]').click(function(e) {
                    e.preventDefault();
                    addToCart($(this).closest('form'));
                });
            }
        });
    }

    function selectCategory_img(data_category) {
        $.ajax({
            url:"view/ajax.php",
            method: "POST",
            data: { data_category_img: data_category },

            success:function(result){
                if(result != ""){
                    $("#product_list").html(result);
                }else if(data_category == "Lọc Theo Danh Mục"){
                    var newHTML = `<h6><i class="fa-light fa-cat fa-2xl"></i> Chưa chọn danh mục!</h6>`;
                    showPopupStatus('Error', newHTML);
                }
                else{
                    var newHTML = `<h6><i class="fa-light fa-cat fa-2xl"></i> Chưa có sản phẩm trong danh mục này!</h6>`;
                    showPopupStatus('Error', newHTML);
                }
                
                $('.sideicons-btn[name="add_cart"]').click(function(e) {
                    e.preventDefault();
                    addToCart($(this).closest('form'));
                });
            }
        });
    }

    // live search Product 3D
    function selectPorduct(selectPorduct) {
        $.ajax({
            url:"view/ajax.php",
            method: "POST",
            data: { selectPorduct: selectPorduct },

            success:function(result){
                $("#product_list").html(result);
                $('.sideicons-btn[name="add_cart"]').click(function(e) {
                    e.preventDefault();
                    addToCart($(this).closest('form'));
                });
            }
        });
    }
    
    function selectPorduct_img(selectPorduct) {
        $.ajax({
            url:"view/ajax.php",
            method: "POST",
            data: { selectPorduct_img: selectPorduct },

            success:function(result){
                $("#product_list").html(result);
                $('.sideicons-btn[name="add_cart"]').click(function(e) {
                    e.preventDefault();
                    addToCart($(this).closest('form'));
                });
            }
        });
    }

    // Add cart page
    $(document).ready(function() {
        $('.sideicons-btn[name="add_cart"]').click(function(e) {
            e.preventDefault();
            addToCart($(this).closest('form'));
        });
    });


    // Add cart details
    $(document).ready(function () {
        $("button[name='add_cart_product']").click(function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            var id = form.find('input[name="id"]').val();
            var name = form.find('input[name="name"]').val();
            var img = form.find('input[name="img"]').val();
            var price = form.find('input[name="price"]').val();
            var sale = form.find('input[name="sale"]').val();
            var type = form.find('input[name="type"]').val();

            var category = form.find('input[name="category"]').val();

            var radioValue1 = $("input[name='radio-card1']:checked").val() || '';
            var radioValue2 = $("input[name='radio-card2']:checked").val() || '';
            var radioValue3 = $("input[name='radio-card3']:checked").val() || '';

            var priceAll =  $("#current-price span").text();

            const mockProduct = {
                name: name,
                image: `Asset/upload/img/${img}`,
                category: category};
            const mockQuantity = 1;

            if(sale != 0){
                showPopup('added to', mockProduct, mockQuantity);
                $.post("view/ajax.php", {
                    id_product: id,
                    name: name,
                    img: img,
                    price: price,
                    sale: sale,
                    type: type,
                    radioValue1:radioValue1,
                    radioValue2:radioValue2,
                    radioValue3:radioValue3,
                    priceAll:priceAll

                }, function(result) {
                    var cartCount = $('#boxcart a span').text(result);
                });
            } else{
                var newHTML = `<h6>Vui lòng liên hệ để biết thêm thông tin!</h6>`;
                showPopupStatus('Error', newHTML);
            }
        });
    });

    $(document).ready(function() {
        $('.delete-bt').click(function() {
            var buttonId = $(this).attr('id');

            var name= $(this).closest('.row').find('.lead').eq(0).text();
            var img = $(this).closest('.row').find('img').attr('src');

            const mockProduct = {
                name: name,
                image: img,
                category: "*"};
            const mockQuantity = "*";
            function simulateAddToCartNotification() {
                showPopup('remove', mockProduct, mockQuantity);
            }
            simulateAddToCartNotification();

            $.post("view/ajax.php", {
                id_product_del: [buttonId]
            }, function(response) {
                var jsonResponse = JSON.parse(response);
                if (jsonResponse[0] === 'success') {
                    $('#' + buttonId).closest('.card.mb-4').remove();
                    var soluong = jsonResponse[1];
                    var cartCount = $('#boxcart a span').text(soluong);
                    var show_cartCount = $('.wishlistNumber span').text(soluong);

                    if(soluong === 0){
                        var newHTML = `
                            <div class="col-lg-12 mt-3 wishlist-container">
                                <div class="alert alert-warning text-center" role="alert">
                                    <i class="fa-light fa-sensor-triangle-exclamation fa-beat" style="color: #ff0000;"></i> &nbsp;&nbsp;There is nothing in your cart.
                                </div>
                        
                                <div class="row btn-header">
                                    <div class="col-lg-12">
                                        <h6>Find out more about Wood 3D products</h6>
                                    </div>
                                </div>
                            </div>
                        `;

                        $('#cart').html(newHTML);
                    }
                }
            });
        });
    }); 
</script>

<!-- Live add like -->
<script>
$(document).ready(function(){
    let isHeartChecked = false;

    $(".fa-heart-circle-plus").click(function(){
        if (!isHeartChecked) {
            // Add like
            var productName = $(this).closest('h3').text();
            gg1 = parseInt($('.old-price').find('span').text().replace(/[^\d]/g, ''));
            gg2 = parseInt($('#current-price').find('span').text().replace(/[^\d]/g, ''));
            gg3 = $('input[name="type"]').val();
            gg4 = $('input[name="img"]').val();
            gg5 = $('input[name="id"]').val();

            if(gg1 != 0 || gg2 !=0){
                $.post("view/ajax.php", {
                    name_like: productName,
                    price: gg1,
                    sale: gg2,
                    type: gg3,
                    img: gg4,
                    id: gg5
                }, function(result) {
                    var cartCount = $('#boxlike a span').text(result);
                });
            } else{
                var newHTML = `<h6>Vui lòng liên hệ để biết thêm thông tin!</h6>`;
                showPopupStatus('Error', newHTML);
            }

            // Alert
            $(this).removeClass("fa-heart-circle-plus").addClass("fa-solid fa-heart-circle-check").css('color', '#ff0000');
            $(this).css('animation', 'tick 0.5s ease-in-out');
            setTimeout(() => {
                $(this).css('animation', '');
            }, 500);
            isHeartChecked = true;
            content =
                ` <h6 class="mb-2">Đã thêm sản phẩm vào sản phẩm yêu thích!</h6>`;
            showPopupStatus('Success',content);
        } else {
            gg5 = $('input[name="id"]').val();

            $.post("view/ajax.php", {
                id_delPage: gg5

            }, function(result) {
                var cartCount = $('#boxlike a span').text(result);
            });


            $(this).removeClass("fa-solid fa-heart-circle-check").addClass("fa-light fa-heart-circle-plus").css('color', '');
            isHeartChecked = false;
            content =
                ` <h6 class="mb-2">Đã xóa sản phẩm khỏi sản phẩm yêu thích!</h6>`;
            showPopupStatus('Error',content);
        }
    });
    
    // Add cart form like
    $(".fa-cart-plus").click(function(){
        if (!isHeartChecked) {
            $(this).removeClass("fa-cart-plus").addClass("fa-solid fa-cart-plus").css('color', '#009F70');
            $(this).css('animation', 'tick 0.5s ease-in-out');
            setTimeout(() => {
                $(this).css('animation', '');
            }, 500);
            isHeartChecked = true;
            content =
                ` <h6 class="mb-2">Đã thêm sản phẩm vào giỏ hàng!</h6>`;
            showPopupStatus('Success',content);
        } else {
            $(this).removeClass("fa-solid fa-cart-plus").addClass("fa-light fa-cart-plus").css('color', '#ff0000');
            isHeartChecked = false;
            content =
                ` <h6 class="mb-2">Đã xóa sản phẩm khỏi giỏ hàng!</h6>`;
            showPopupStatus('Error',content);
        }
    });

    // Del like
    $(document).ready(function() {
        $('.delete-like').click(function() {
            var buttonId = $(this).attr('id');

            var name= $(this).closest('.row').find('.lead').eq(0).text();
            var img = $(this).closest('.row').find('img').attr('src');

            const mockProduct = {
                name: name,
                image: img,
                category: "*"};
            const mockQuantity = "*";
            function simulateAddToCartNotification() {
                showPopup('remove', mockProduct, mockQuantity);
            }
            simulateAddToCartNotification();

            $.post("view/ajax.php", {
                id_delPage: [buttonId]
            }, function(response) {
                $('#' + buttonId).closest('.card.mb-4').remove();
                var cartCount = $('#boxlike a span').text(response);
                var show_cartCount = $('.wishlistNumber1 span').text(response);
                console.log(response);

                if(response == "0" || response == 0){
                    var newHTML = `
                        <div class="col-lg-12 mt-3 wishlist-container">
                            <div class="alert alert-warning text-center" role="alert">
                                <i class="fa-light fa-sensor-triangle-exclamation fa-beat" style="color: #ff0000;"></i> &nbsp;&nbsp;There is nothing in your cart.
                            </div>
                    
                            <div class="row btn-header">
                                <div class="col-lg-12">
                                    <h6>Find out more about Wood 3D products</h6>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#cart').html(newHTML);
                }
            });
        });

    });
});

</script>

<!-- Live buy now -->
<script>
    $(document).ready(function () {
        $("button[name='checkout_product']").click(function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            var id = form.find('input[name="id"]').val();
            var name = form.find('input[name="name"]').val();
            var img = form.find('input[name="img"]').val();
            var price = form.find('input[name="price"]').val();
            var sale = form.find('input[name="sale"]').val();
            var type = form.find('input[name="type"]').val();

            var category = form.find('input[name="category"]').val();

            var radioValue1 = $("input[name='radio-card1']:checked").val() || '';
            var radioValue2 = $("input[name='radio-card2']:checked").val() || '';
            var radioValue3 = $("input[name='radio-card3']:checked").val() || '';

            var priceAll =  $("#current-price span").text();

            const mockProduct = {
                name: name,
                image: `Asset/upload/img/${img}`,
                category: category};
            const mockQuantity = 1;

            if(sale != 0){
                showPopup('added to', mockProduct, mockQuantity);
                $.post("view/ajax.php", {
                    id_product_checkout: id,
                    name: name,
                    img: img,
                    price: price,
                    sale: sale,
                    type: type,
                    radioValue1:radioValue1,
                    radioValue2:radioValue2,
                    radioValue3:radioValue3,
                    priceAll:priceAll
                });

                console.log(name);

                window.location.href = 'index.php?pg=checkout';
            } else{
                var newHTML = `<h6>Vui lòng liên hệ để biết thêm thông tin!</h6>`;
                showPopupStatus('Error', newHTML);
            }
        });
    });
</script>

<!-- Live checkout -->
<script>
    $(document).ready(function() {
        $('#getProvince').click(function() {
            var address1 = $('#province option:selected').text();
            var address2 = $('#district option:selected').text();
            var address3 = $('#ward option:selected').text();

            var ship = parseInt($('.ship h7 span').text().replace(/\./g, ''), 10);
            var discount = parseInt($('.discount h7 span').text().replace(/\./g, ''), 10);
            var total = parseInt($('.total h5 span').text().replace(/\./g, ''), 10);

            $.ajax({
                url: 'view/ajax.php',
                method: 'POST',
                data: {
                    province: address1,
                    district: address2,
                    ward: address3,
                    ship: ship,
                    discount: discount,
                    total: total
                }
            });
        });
    });
</script>
<!-- =================== End Live ================= -->



<!-- =================== Other ================= -->
<!-- Back to Top -->
<script>
    var mybutton = document.getElementById("myBtn");
    window.onscroll = function() {scrollFunction();};
    var navbar = document.querySelector(".nav-bar-container");
    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        window.scrollTo({top: 0, behavior: 'smooth'})};
</script>

<!-- Aos -->
<script>
    AOS.init({
        disable: function() {
            var maxWidth = 1077;
            return (window.innerWidth < maxWidth);
        }
    });
</script>

<!-- Cảnh báo thiếu input -->
<script>
    function notification(status,message) {
        if(status == "Error"){
            return `
            <div class="container">
                <div class="row">
                    <div class="col-4 col-lg-4 text-center">
                        <img src="Asset/img/canhbao.png" class="img-fluid">
                    </div>
                    <div class="noti-detail col-7 col-lg-7">
                        <h5 class="text-center mb-2" style="color: red;">Alert <i class="fa-regular fa-exclamation fa-beat-fade" style="color: #ff0000;"></i></h5>
                        ${message}
                    </div>
                    <div class="col-1 col-lg-1">
                        <button class="close float-right" onclick="closePopup()"><i class="fa-solid fa-xmark fa-beat-fade"></i></button>
                    </div>
                </div>
            </div>`;

        } else if (status == "Success"){
            return `
            <div class="container">
                <div class="row">
                    <div class="noti-image col-4 col-lg-4 text-center">
                        <img src="Asset/img/thanhcong1.png" width="80px"">
                    </div>
                    <div class="noti-detail col-7 col-lg-7">
                        <h5 class="text-center mb-2" style="color: #009F70;">Success <i class="fa-light fa-thumbs-up fa-bounce" style="color: #009F70;"></i></h5>
                        ${message}
                    </div>
                    <div class="col-1 col-lg-1">
                        <button class="close float-right" onclick="closePopup()"><i class="fa-solid fa-xmark fa-beat-fade"></i></button>
                    </div>
                </div>
            </div>`;
        }
    }

    function showPopupStatus(status,message) {
        let noti = document.querySelector('.notification-toast');
        noti.style.display = "block";
        const notificationContent = notification(status,message);
        noti.innerHTML = notificationContent;
        noti.classList.remove("animate__fadeOutLeft");
        noti.classList.add("animate__fadeInLeft");
        setTimeout(closePopup, 5000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form[action="index.php?pg=checkout_product"]');
        form.addEventListener('submit', function(event) {
            const firstName = document.querySelector('input[name="f_name"]').value;
            const lastName = document.querySelector('input[name="l_name"]').value;
            const phoneNumber = document.querySelector('input[name="p_number"]').value;
            const email = document.querySelector('input[name="email"]').value;
            
            const provinceSelect = document.getElementById('province');
            const districtSelect = document.getElementById('district');
            const wardSelect = document.getElementById('ward');
            const houseNumber = document.querySelector('input[name="h_number"]').value;

            const checkbox = document.getElementById('Give-It-An-Id');

            let content = '';
            if (!(firstName.trim()  && lastName.trim() && phoneNumber.trim() && email.trim())) {
                content +=
                `
                    <h6 class="mb-2"><i class="fa-light fa-user fa-beat-fade fa-xl"></i> <a href="index.php?pg=checkout#personal"> Missing Personal Info!</a> (1)</h6>
                `;
            }

            if (!(provinceSelect.value && districtSelect.value && wardSelect.value && houseNumber.trim())) {
                content +=
                `
                    <h6 class="mb-2"><i class="fa-light fa-address-card fa-flip fa-xl"></i> <a href="index.php?pg=checkout#address"> Missing Address Info!</a> (2)</h6>
                `;
            }

            if (!checkbox.checked) {
                content +=
                `
                <h6 class="mb-2"><i class="fa-light fa-siren-on fa-beat fa-xl"></i> <a href="index.php?pg=checkout#policy"> Missing Sales Policy!</a> (5)</h6>
                `;
            }

            if (content !== '') {
                showPopupStatus('Error',content);
                event.preventDefault();
            }
        });
    });
</script>


<script>
    // JavaScript
    document.addEventListener("DOMContentLoaded", function() {
        const thumbs = document.querySelectorAll('.product-thumbs-track .pt');

        thumbs.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const bigImg = document.querySelector('.product-big-img');
                const imgUrl = this.getAttribute('data-imgbigurl');
                bigImg.src = imgUrl;
            });
        });
    });

    // Function to handle image modal display
    $(document).ready(function () {
        $('.product-pic-zoom').on('click', function () {
            let imgUrl = $(this).find('img').attr('src');
            $('#modalImage').attr('src', imgUrl);
            $('#imageModal').modal('show');
        });

        $('.product-thumbs-track').on('click', '.pt', function () {
            let imgUrl = $(this).data('imgbigurl');
            $('#modalImage').attr('src', imgUrl);
        });
    });

    
    $(document).ready(function () {
        var zoomed = false;

        $('#imageModal').on('show.bs.modal', function () {
            $('.zoomable .modal-body img').off('dblclick').on('dblclick', function () {
                if (!zoomed) {
                    $(this).addClass('zoom-in');
                    zoomed = true;
                } else {
                    $(this).removeClass('zoom-in');
                    zoomed = false;
                }
            });
        });

        $('#imageModal').on('hidden.bs.modal', function () {
            $('.zoomable .modal-body img').removeClass('zoom-in');
            zoomed = false;
        });
    });
</script>


<script>
    const numStars = 5;
    const ratingDiv = document.getElementById('ratingStars');

    for (let i = 1; i <= numStars; i++) {
    const input = document.createElement('input');
    input.type = 'radio';
    input.id = `star-${i}`;
    input.name = 'star-radio';
    input.value = `star-${i}`;

    const label = document.createElement('label');
    label.htmlFor = `star-${i}`;

    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    svg.setAttribute('viewBox', '0 0 24 24');

    const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    path.setAttribute('pathLength', '360');
    path.setAttribute('d', 'M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z');

    svg.appendChild(path);
    label.appendChild(svg);
    ratingDiv.appendChild(input);
    ratingDiv.appendChild(label);
    }
</script>
<?=$html_alert;?>
<!-- =================== End Other ================= -->
</body>
</html>