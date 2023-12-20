const modelViewer = document.getElementById('modelViewer');

if (modelViewer) {
    const fullscreenButton = document.getElementById('fullscreenButton');
    fullscreenButton.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            if (modelViewer.requestFullscreen) {
                modelViewer.requestFullscreen();
            } else if (modelViewer.mozRequestFullScreen) {
                modelViewer.mozRequestFullScreen();
            } else if (modelViewer.webkitRequestFullscreen) {
                modelViewer.webkitRequestFullscreen();
            } else if (modelViewer.msRequestFullscreen) {
                modelViewer.msRequestFullscreen();
            }
            
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
            
        }
    }); 
};







