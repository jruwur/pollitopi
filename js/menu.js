function mostrarAlerta() {
        var modal = document.createElement("div");
        modal.style.position = "fixed";
        modal.style.top = "0";
        modal.style.left = "0";
        modal.style.width = "100%";
        modal.style.height = "100%";
        modal.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
        modal.style.display = "flex";
        modal.style.justifyContent = "center";
        modal.style.alignItems = "center";
        modal.style.zIndex = "9999";

        var mensaje = document.createElement("div");
        mensaje.style.backgroundColor = "#fff";
        mensaje.style.padding = "24px";
        mensaje.style.borderRadius = "8px";
        mensaje.style.textAlign = "center";

        var titulo = document.createElement("h1");
        titulo.textContent = "Comprado";
        titulo.style.fontSize = "24px";
        titulo.style.marginTop = "0";

        var contenido = document.createElement("p");
        contenido.textContent = "¡su compra se ha realizado con exito!";
        contenido.style.fontSize = "18px";

        var botonCerrar = document.createElement("button");
        botonCerrar.textContent = "Cerrar";
        botonCerrar.style.backgroundColor = "#007bff";
        botonCerrar.style.color = "#fff";
        botonCerrar.style.border = "none";
        botonCerrar.style.padding = "8px 16px";
        botonCerrar.style.cursor = "pointer";
        botonCerrar.style.marginTop = "16px";
        botonCerrar.style.fontSize = "16px";
        botonCerrar.addEventListener("click", function() {
            modal.style.display = "none";
        });

        mensaje.appendChild(titulo);
        mensaje.appendChild(contenido);
        mensaje.appendChild(botonCerrar);

        modal.appendChild(mensaje);
        document.body.appendChild(modal);
    }
