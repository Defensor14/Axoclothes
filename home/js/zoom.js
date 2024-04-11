function zoom(e) {
    var zoomer = e.currentTarget;
    var offsetX, offsetY;
    if (e.offsetX !== undefined && e.offsetY !== undefined) {
        offsetX = e.offsetX;
        offsetY = e.offsetY;
    } else {
        offsetX = e.touches[0].pageX;
        offsetY = e.touches[0].pageY;
    }
    x = offsetX / zoomer.offsetWidth * 100;
    y = offsetY / zoomer.offsetHeight * 100;
    zoomer.style.backgroundSize = '250%'; // Ajusta el tamaño del fondo para simular el zoom
    zoomer.style.backgroundPosition = x + '% ' + y + '%';
}
