document.addEventListener("DOMContentLoaded", function () {
    const contenedorTarjetas = document.getElementById("contenedor_tarjetas");
    const tarjetaBase = document.getElementById("tarjeta-base");

    Catalogo.forEach(articulo => {
        const nuevaTarjeta = document.createElement("div");
        nuevaTarjeta.classList.add("col", "mb-5", "tarjeta");

        // Crea la nueva tarjeta basada en la tarjeta base y reemplaza su contenido
        nuevaTarjeta.innerHTML = tarjetaBase.innerHTML;

        // Modifica el contenido de la tarjeta dinámica según los datos del artículo
        nuevaTarjeta.querySelector("#titulo").innerText = articulo.texto.titulo;
        nuevaTarjeta.querySelector("#tipo").innerText = articulo.texto.tipo;
        nuevaTarjeta.querySelector("#precio").innerText = articulo.texto.precio;
        nuevaTarjeta.querySelector(".card-img-top").src = articulo.img;

        // Agrega la nueva tarjeta al contenedor de tarjetas
        contenedorTarjetas.appendChild(nuevaTarjeta);
    });

    // Muestra la tarjeta base después de agregar las tarjetas dinámicas
    tarjetaBase.style.display = "none";
});
