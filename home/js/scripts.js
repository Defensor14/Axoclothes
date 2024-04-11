const terjeta = document.querySelector("#tarjeta");


const estados_posibles = {
    visisble: "texto_visible",
    oculto: "texto_oculto"
}  

let estado_actual = estados_posibles.oculto

function mostrando(){
    if(estado_actual == estados_posibles.oculto){
        document.body.style.overflow="hidden"

        Catalogo.forEach( articulo =>  {
            console.log(articulo)
            console.log(Catalogo)
            let tarjeta_nuea = terjeta.cloneNode(true)

            tarjeta_nuea.querySelector("#titulo").innerText = articulo.texto.titulo ?? "Erro 404"
            tarjeta_nuea.querySelector("#tipo").innerText = articulo.texto.tipo ?? ""
            tarjeta_nuea.querySelector("#precio").innerText = articulo.texto.precio ?? ""

            document.querySelector("#contenedor_tarjetas").appendChild(tarjeta_nuea);
        })


       /* if(entrada_encontrada.texto.tecnica){
            texto_lateral.querySelector("#tecnica_place").innerText = entrada_encontrada.texto.tecnica
            texto_lateral.querySelector("#tecnica").classList.remove("display_hide")
        }
        else{   
            texto_lateral.querySelector("#tecnica").classList.add("display_hide")
        }

let entrada_encontrada = Catalogo.find((entrada) => entrada.id == argumentos[1]) ?? 
            {texto: "Parece que no tenemos ese dato"}

        texto_lateral.querySelector("#titulo").innerText = entrada_encontrada.texto.titulo ?? "Erro 404"
        texto_lateral.querySelector("#tipo").innerText = entrada_encontrada.texto.tipo ?? ""
        texto_lateral.querySelector("#precio").innerText = entrada_encontrada.texto.precio ?? ""
        if(entrada_encontrada.video){
            imagen_lateral.querySelector("img").style.display = 'none'
            imagen_lateral.querySelector("video").style.display = 'flex'
            imagen_lateral.querySelector("video").src = entrada_encontrada.video

            imagen_lateral.style.width = "100vw"
            imagen_lateral.style.height = "65vh"

            texto_lateral.style.width = "100vw"
            texto_lateral.style.height = "35vh"
            texto_lateral.style.marginTop ="65vh"

        } */
        
        imagen_lateral.querySelector("img").src = entrada_encontrada.img ?? ""

        estado_actual = estados_posibles.visisble
    }
}

