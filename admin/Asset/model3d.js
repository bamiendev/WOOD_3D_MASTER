const modelViewer = document.getElementById('modelViewer');

// Tham chieu button:
const button_hidden_all = document.getElementById("button_hidden_all");
const button_show_all = document.getElementById("button_shows_all");

// Import FIle Glb
document.getElementById('fileInput').addEventListener('change', function (event) {
  const file = event.target.files[0];
  if (file) {
    const modelURL = URL.createObjectURL(file);
    modelViewer.setAttribute('src', modelURL);

    // Hiển thị thông tin file trong form-group
    const fileName = file.name; // Lấy tên file
    const fileSize = (file.size / (1024 * 1024)).toFixed(2); // Lấy kích thước file (đã làm tròn đến 2 chữ số thập phân)

    // Tạo HTML để hiển thị thông tin file
    const fileInfoHTML = `
    <div class="row mb-4">
        <div class="col-6">
            <h3 for="importedFileName">Tên file: </h3>
            <input name="file_glb" type="text" id="importedFileName" class="form-control" value="${fileName}" readonly>
        </div>

        <div class="col-6">
            <h3 for="importedFileSize">Kích thước (MB): </h3>
            <input type="text" id="importedFileSize" class="form-control" value="${fileSize}" readonly>
        </div>
    </div>
    `;

    // Hiển thị thông tin file trong form-group
    const formGroup = document.querySelector('#page_material .form-group');
    formGroup.innerHTML = fileInfoHTML;
    document.getElementById('page_material').classList.remove('d-none'); // Hiển thị #page_addProduct nếu đang ẩn
  }
});
function openFile() {
  document.getElementById('fileInput').click();
}


// Button materials
const buttonContainer = document.getElementById("material-buttons");
let selectedMaterialName = null;

// Materials:
modelViewer.addEventListener("load", (ev) => {
    let oldButtons = document.querySelectorAll('#AlphaCutoffButton');
    oldButtons.forEach((button) => {
        button.parentNode.removeChild(button);
    });

    let materials = modelViewer.model.materials;
    materials.forEach((material) => {
        let materialName = material.name;
        let button = document.createElement("button");
        button.textContent = materialName;
        button.id = `AlphaCutoffButton`
        button.type = "button";
        button.className = "btn btn-outline-primary";
        material.setAlphaMode("MASK");
        material.setAlphaCutoff(2);

        button.addEventListener("click", () => {
            materials.forEach((material) => {
                material.setAlphaCutoff(2);
            });
            material.setAlphaCutoff(0.01);
            selectedMaterialName = materialName;
        });
        buttonContainer.appendChild(button);
        
    });
});

// Checkbox
modelViewer.addEventListener("load", (ev) => {
    let containers = {
        type: document.getElementById("input_materials"),
        type1: document.getElementById("input_materials_type1"),
        type2: document.getElementById("input_materials_type2"),
        type3: document.getElementById("input_materials_type3")
    };

    let selectedCheckboxes = new Set();

    let materials = modelViewer.model.materials;
    function createCheckbox(container,type_checkbox) {
        container.innerHTML = '';

        materials.forEach((material) => {
            let materialName = material.name;

            let checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.value = materialName;
            checkbox.name = `type${type_checkbox}[]`;
            checkbox.className = "form-check-input";
            checkbox.id = `MaterialCheckbox_${materialName.toLowerCase().replace(/\s+/g, '_')}`;

            let label = document.createElement("label");
            label.innerHTML = materialName;
            label.htmlFor = `MaterialCheckbox_${materialName.toLowerCase().replace(/\s+/g, '_')}`;

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

    createCheckbox(containers.type,0);
    createCheckbox(containers.type1,1);
    createCheckbox(containers.type2,2);
    createCheckbox(containers.type3,3);
});

// Button Change Metalness Roughness
modelViewer.addEventListener("load", (ev) => {
    document.querySelector('#metalness').addEventListener('input', (event) => {
        if (selectedMaterialName) {
            let material = modelViewer.model.materials.find(m => m.name === selectedMaterialName);
            if (material) {
                material.pbrMetallicRoughness.setMetallicFactor(event.target.value);
                metalnessDisplay.textContent = event.target.value;
            }
        }
    });

    document.querySelector('#roughness').addEventListener('input', (event) => {
        if (selectedMaterialName) {
            let material = modelViewer.model.materials.find(m => m.name === selectedMaterialName);
            if (material) {
                material.pbrMetallicRoughness.setRoughnessFactor(event.target.value);
                roughnessDisplay.textContent = event.target.value;
            }
        }
    });
});

// Button captures
document.addEventListener('DOMContentLoaded', () => {
    const captureImage = (buttonId, capturedImageClass) => {
        const downloadButton = document.querySelector(buttonId);

        const download = async () => {
        const ModelViewerElement = customElements.get('model-viewer');
        const oldMinScale = ModelViewerElement.minimumRenderScale;
        ModelViewerElement.minimumRenderScale = 1;

        // Mặc định là play
        modelViewer.pause();
        modelViewer.currentTime = 0;

        const CameraOrbit = modelViewer.getCameraOrbit();
        const CameraOrbitArray = [CameraOrbit.theta, CameraOrbit.phi, CameraOrbit.radius];
        const phi = parseFloat(CameraOrbitArray[0]) * (180 / Math.PI);
        const theta = parseFloat(CameraOrbitArray[1]) * (180 / Math.PI);
        const radius = parseFloat(CameraOrbitArray[2]);
        const formattedString = phi.toFixed(1) + 'deg ' + theta.toFixed(1) + 'deg ' + radius.toFixed(1) + 'm';

        const initialCameraOrbit = formattedString;
        modelViewer.cameraOrbit = initialCameraOrbit;
        modelViewer.autoRotate = false;
        modelViewer.interactionPrompt = 'none';
        modelViewer.resetTurntableRotation();
        modelViewer.jumpCameraToGoal();

        await new Promise(resolve => requestAnimationFrame(() => requestAnimationFrame(resolve)));

        const thumbnailBlob = await modelViewer.toBlob({ mimeType: 'image/png'});

        modelViewer.pause();
        modelViewer.autoRotate = false;
        modelViewer.interactionPrompt = 'auto';
        ModelViewerElement.minimumRenderScale = oldMinScale;

        const capturedImages = document.querySelectorAll('.' + capturedImageClass);
        capturedImages.forEach((image, index) => {
            image.src = URL.createObjectURL(thumbnailBlob);
        });
        };
        downloadButton.addEventListener('click', download);
    };
    captureImage('#download_1', 'capturedImage1');
    captureImage('#download_2', 'capturedImage2');
});

// Button Hide / Show ALL
document.addEventListener("DOMContentLoaded", function() {
    modelViewer.addEventListener('load', () => {
        let materials = modelViewer.model.materials;
        materials.forEach((material) => {
            material.setAlphaMode('MASK');
            material.setAlphaCutoff(0.01);
        });
    });

    if (button_hidden_all && button_show_all) {
        button_hidden_all.addEventListener("click", () => {
            let materials = modelViewer.model.materials;
            materials.forEach((material) => {
                material.setAlphaMode("MASK");
                material.setAlphaCutoff(2);
            });
        });
        button_show_all.addEventListener("click", () => {
            let materials = modelViewer.model.materials;
            materials.forEach((material) => {
                material.setAlphaMode("MASK");
                material.setAlphaCutoff(0.01);
            });
        });
    } else {
        console.error('Không tìm thấy các button');
    }
});

// Anim
document.addEventListener("DOMContentLoaded", function() {
    const modelViewer = document.getElementById('modelViewer');
    const animationSelect = document.getElementById('animationSelect');

    const defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.textContent = 'Không chọn gì';
    
    modelViewer.addEventListener('load', () => {
        animationSelect.innerHTML = '';
        const animationNames = modelViewer.availableAnimations.map(animation => animation);
        animationSelect.appendChild(defaultOption);

        if (animationNames.length === 0) {
            modelViewer.setAttribute('autoplay', 'false');
        } else {
            animationNames.forEach(name => {
                const option = document.createElement('option');
                option.value = name;
                option.textContent = name;
                animationSelect.appendChild(option);
            });
        }
    });

    animationSelect.addEventListener('change', function() {
        const selectedAnimation = this.value;
        if (selectedAnimation === '') {
            modelViewer.pause();
            modelViewer.currentTime = 0;
        } else {
            // Nếu chọn một animation khác, thiết lập animation mới
            modelViewer.play();
            modelViewer.setAttribute('animation-name', selectedAnimation);
        }
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const modelViewer = document.getElementById('modelViewer');
    const checkbox = modelViewer.querySelector('#show-dimensions');
    const dimElements = [...modelViewer.querySelectorAll('button'), modelViewer.querySelector('#dimLines')];

    function setVisibility(visible) {
        dimElements.forEach((element) => {
            if (visible) {
                element.classList.remove('hide');
            } else {
                element.classList.add('hide');
            }
        });
    }

    setVisibility(false);
    
    checkbox.addEventListener('change', () => {
        setVisibility(checkbox.checked);
    });

    modelViewer.addEventListener('ar-status', (event) => {
        setVisibility(event.detail.status !== 'session-started');
    });

    // update svg
    function drawLine(svgLine, dotHotspot1, dotHotspot2, dimensionHotspot) {
        if (dotHotspot1 && dotHotspot2) {
            svgLine.setAttribute('x1', dotHotspot1.canvasPosition.x);
            svgLine.setAttribute('y1', dotHotspot1.canvasPosition.y);
            svgLine.setAttribute('x2', dotHotspot2.canvasPosition.x);
            svgLine.setAttribute('y2', dotHotspot2.canvasPosition.y);

            // use provided optional hotspot to tie visibility of this svg line to
            if (dimensionHotspot && !dimensionHotspot.facingCamera) {
                svgLine.classList.add('hide');
            }
            else {
                svgLine.classList.remove('hide');
            }
        }
    }

    const dimLines = modelViewer.querySelectorAll('line');

    const renderSVG = () => {
        drawLine(dimLines[0], modelViewer.queryHotspot('hotspot-dot+X-Y+Z'), modelViewer.queryHotspot('hotspot-dot+X-Y-Z'), modelViewer.queryHotspot('hotspot-dim+X-Y'));
        drawLine(dimLines[1], modelViewer.queryHotspot('hotspot-dot+X-Y-Z'), modelViewer.queryHotspot('hotspot-dot+X+Y-Z'), modelViewer.queryHotspot('hotspot-dim+X-Z'));
        drawLine(dimLines[2], modelViewer.queryHotspot('hotspot-dot+X+Y-Z'), modelViewer.queryHotspot('hotspot-dot-X+Y-Z')); // always visible
        drawLine(dimLines[3], modelViewer.queryHotspot('hotspot-dot-X+Y-Z'), modelViewer.queryHotspot('hotspot-dot-X-Y-Z'), modelViewer.queryHotspot('hotspot-dim-X-Z'));
        drawLine(dimLines[4], modelViewer.queryHotspot('hotspot-dot-X-Y-Z'), modelViewer.queryHotspot('hotspot-dot-X-Y+Z'), modelViewer.queryHotspot('hotspot-dim-X-Y'));
    };

    modelViewer.addEventListener('load', () => {
        const center = modelViewer.getBoundingBoxCenter();
        const size = modelViewer.getDimensions();
        const x2 = size.x / 2;
        const y2 = size.y / 2;
        const z2 = size.z / 2;

        modelViewer.updateHotspot({
            name: 'hotspot-dot+X-Y+Z',
            position: `${center.x + x2} ${center.y - y2} ${center.z + z2}`
        });

        modelViewer.updateHotspot({
            name: 'hotspot-dim+X-Y',
            position: `${center.x + x2 * 1.2} ${center.y - y2 * 1.1} ${center.z}`
        });
        modelViewer.querySelector('button[slot="hotspot-dim+X-Y"]').textContent =
            `${(size.z * 100).toFixed(0)} cm`;

        modelViewer.updateHotspot({
            name: 'hotspot-dot+X-Y-Z',
            position: `${center.x + x2} ${center.y - y2} ${center.z - z2}`
        });

        modelViewer.updateHotspot({
            name: 'hotspot-dim+X-Z',
            position: `${center.x + x2 * 1.2} ${center.y} ${center.z - z2 * 1.2}`
        });
        modelViewer.querySelector('button[slot="hotspot-dim+X-Z"]').textContent =
            `${(size.y * 100).toFixed(0)} cm`;

        modelViewer.updateHotspot({
            name: 'hotspot-dot+X+Y-Z',
            position: `${center.x + x2} ${center.y + y2} ${center.z - z2}`
        });

        modelViewer.updateHotspot({
            name: 'hotspot-dim+Y-Z',
            position: `${center.x} ${center.y + y2 * 1.1} ${center.z - z2 * 1.1}`
        });
        modelViewer.querySelector('button[slot="hotspot-dim+Y-Z"]').textContent =
            `${(size.x * 100).toFixed(0)} cm`;

        modelViewer.updateHotspot({
            name: 'hotspot-dot-X+Y-Z',
            position: `${center.x - x2} ${center.y + y2} ${center.z - z2}`
        });

        modelViewer.updateHotspot({
            name: 'hotspot-dim-X-Z',
            position: `${center.x - x2 * 1.2} ${center.y} ${center.z - z2 * 1.2}`
        });
        modelViewer.querySelector('button[slot="hotspot-dim-X-Z"]').textContent =
            `${(size.y * 100).toFixed(0)} cm`;

        modelViewer.updateHotspot({
            name: 'hotspot-dot-X-Y-Z',
            position: `${center.x - x2} ${center.y - y2} ${center.z - z2}`
        });

        modelViewer.updateHotspot({
            name: 'hotspot-dim-X-Y',
            position: `${center.x - x2 * 1.2} ${center.y - y2 * 1.1} ${center.z}`
        });
        modelViewer.querySelector('button[slot="hotspot-dim-X-Y"]').textContent =
            `${(size.z * 100).toFixed(0)} cm`;

        modelViewer.updateHotspot({
            name: 'hotspot-dot-X-Y+Z',
            position: `${center.x - x2} ${center.y - y2} ${center.z + z2}`
        });

        renderSVG();

        modelViewer.addEventListener('camera-change', renderSVG);
    });
});






