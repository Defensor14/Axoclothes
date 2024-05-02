
function formulario() {
    const registerForm = document.getElementById("register-form");
    const errorMessage = document.getElementById("error-message");

        console.log("ola")

    registerForm.addEventListener("submit", function(event) {
        console.log("ola")

        event.preventDefault();

        const firstName = registerForm.elements["firstName"].value;
        const lastName = registerForm.elements["lastName"].value;
        const email = registerForm.elements["email"].value;
        const password = registerForm.elements["password"].value;
        const pais = registerForm.elements["pais"].value;
        const address = registerForm.elements["address"].value;
        const telefono = registerForm.elements["telefono"].value;

        // Validación básica
        if (firstName.trim() === "" || lastName.trim() === "" || email.trim() === "" || password.trim() === "" || pais.trim() === "" || address.trim() === "" || telefono.trim() === ""  ) {
            errorMessage.textContent = "Por favor, completa todos los campos.";
        } else {
            // Verificar si el nombre de usuario ya está registrado
            if (localStorage.getItem(email)) {
                errorMessage.textContent = "Este correo electrónico ya está registrado";
            } else {
                // Guardar datos en el almacenamiento local del navegador
                const userData = {
                    firstName: firstName,
                    lastName: lastName,
                    email: email,
                    password: password,
                    pais: pais,
                    address: address,
                    telefono: telefono
                };
                localStorage.setItem(email, JSON.stringify(userData)); // Almacenar los datos de usuario en JSON
                
                // Redirigir al usuario a la página de inicio de sesión
                window.location.href = "index.html";
            }
        }
    });
}

document.addEventListener("DOMContentLoaded", formulario );



function showConfirmationModal() {
    // Crear elementos de la ventana emergente
    const modalContainer = document.createElement("div");
    modalContainer.classList.add("modal-container");

    const modalContent = document.createElement("div");
    modalContent.classList.add("modal-content");

    const message = document.createElement("p");
    message.textContent = "¡Registro exitoso!";

    const continueButton = document.createElement("button");
    continueButton.textContent = "Continuar";
    continueButton.addEventListener("click", function() {
        window.location.href = "IndexCrearDibujo.html";
    });

    // Agregar elementos al DOM
    modalContent.appendChild(message);
    modalContent.appendChild(continueButton);
    modalContainer.appendChild(modalContent);
    document.body.appendChild(modalContainer);
}




