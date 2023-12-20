
// ---------------------------------------------Side Bar--------------------------------------------=====
const menuBar = document.querySelector('.sidebar nav .bx.bx-menu');
const sideBar = document.querySelector('.sidebar');

menuBar.addEventListener('click', () => {
    sideBar.classList.toggle('close');
});

// ---------------------------------------------Page 3D Page --------------------------------------------
function showPage(pageId) {
  var pages = ['page_material', 'page_capture', 'page_button', 'page_addProduct'];
  pages.forEach(function (id) {
      var page = document.querySelector('#' + id);
      page.classList.remove('d-block');
      page.classList.add('d-none');
  });
  var page = document.querySelector('#' + pageId);
  page.classList.remove('d-none');
  page.classList.add('d-block');
}
  
document.querySelector('#material').addEventListener('click', function () {
  showPage('page_material');
});

document.querySelector('#capture').addEventListener('click', function () {
  showPage('page_capture');
});

document.querySelector('#button').addEventListener('click', function () {
  showPage('page_button');
});

document.querySelector('#addProduct').addEventListener('click', function () {
  showPage('page_addProduct');
});

document.querySelector('#material input[type="radio"]').click();

// ---------------------------------------------Script Img--------------------------------------------
function displayImages() {
  var groupValue = document.getElementById('groupSelect').value;
  var imageValue = document.getElementById('imageSelect').value;
  var imagesContainer = document.getElementById('imagesContainer');

  imagesContainer.innerHTML = '';

  // Function to generate HTML for images
  function img_show_options(startIndex, endIndex, imageCount) {
      let html = '';
      for (let i = startIndex; i <= endIndex; i++) {
          html += `
              <div class="col-3">
                  <img class="img-fluid" src="../Asset/img/img.jpg" id="capturedOption${i}">
              </div>`;
      }
      return `<div class="row text-center">${html}</div>`;
  }

  if (imageValue >= '1' && imageValue <= '4') {
      const imagesCount = parseInt(imageValue);
      let generatedHTML = '';

      if (groupValue === '1') {
          generatedHTML = img_show_options(1, imagesCount, imagesCount);
      } else if (groupValue === '2') {
          generatedHTML += img_show_options(1, imagesCount, imagesCount);
          generatedHTML += img_show_options(5, imagesCount + 4, imagesCount);
      } else if (groupValue === '3') {
          generatedHTML += img_show_options(1, imagesCount, imagesCount);
          generatedHTML += img_show_options(5, imagesCount + 4, imagesCount);
          generatedHTML += img_show_options(9, imagesCount + 8, imagesCount);
      }

      imagesContainer.innerHTML = generatedHTML;
  }
}

document.getElementById('confirmButton').addEventListener('click', function() {
  var groupValue = parseInt(document.getElementById('groupSelect').value);
  var imageValue = parseInt(document.getElementById('imageSelect').value);

  var chupanhSelect = document.getElementById('chupanh');
  chupanhSelect.innerHTML = '<option selected>Chụp Ảnh</option>';     

  var totalOptions = groupValue * imageValue;
  
  for (var i = 1; i <= totalOptions; i++) {
      var option = document.createElement('option');
      option.value = i;
      option.textContent = i;
      chupanhSelect.appendChild(option);
  }
});

// ---------------------------------------------Toast Alert--------------------------------------------
function showSuccessToast(message) {
  toast({
      title: "Thành công!",
      message: message, // Sử dụng tham số message thay vì chuỗi cụ thể
      type: "success",
      duration_ver1: 3000
  });
}

function showErrorToast(message) {
  toast({
      title: "Thất Bại!",
      message: message,
      type: "error",
      duration_ver1: 5000
  });
}

function showInfoToast(message) {
  toast({
      title: "Cảnh Báo!",
      message: message,
      type: "warning",
      duration_ver1: 5000
  });
}

function toast({ title = "", message = "", type = "info", duration_ver1 = 3000 }) {
  const main = document.getElementById("toast");
  if (main) {
      const toast = document.createElement("div");

      // Auto remove toast
      const autoRemoveId = setTimeout(function () {
          main.removeChild(toast);
      }, duration_ver1 + 1000);

      // Remove toast when clicked
      toast.onclick = function (e) {
          if (e.target.closest(".toast__close")) {
              main.removeChild(toast);
              clearTimeout(autoRemoveId);
          }
      };

      const icons = {
          success: "fas fa-check-circle",
          info: "fas fa-info-circle",
          warning: "fas fa-exclamation-circle",
          error: "fas fa-exclamation-circle"
      };
      const icon = icons[type];
      const delay = (duration_ver1 / 1000).toFixed(2);

      toast.classList.add("toast", `toast--${type}`);
      toast.style.animation = `slideInLeft ease 1.2s, fadeOut linear 2s ${delay}s forwards`;

      toast.innerHTML = `
            <div class="toast__icon">
                <i class="${icon}"></i>
            </div>
            <div class="toast__body">
                <h3 class="toast__title">${title}</h3>
                <p class="toast__msg">${message}</p>
            </div>
            <div class="toast__close">
                <i class="fas fa-times"></i>
            </div>
        `;
      main.appendChild(toast);
  }
}

// ---------------------------------------------Display img input--------------------------------------------

