document.addEventListener("DOMContentLoaded", function () {
  eventListeners();
  darkMode();
  apagarAlerta();
});

function darkMode() {
  // codigo para leer las preferencias del sistema y definir si es claro u oscuro
  const prefiereDarkMode = window.matchMedia("(prefers-color-scheme: dark)");
  if (prefiereDarkMode.matches) {
    document.body.classList.add("dark-mode");
  } else {
    document.body.classList.remove("dark-mode");
  }
  // evento para cambiar automaticamente al cambiar el modo del sistema
  prefiereDarkMode.addEventListener("change", function () {
    if (prefiereDarkMode.matches) {
      document.body.classList.add("dark-mode");
    } else {
      document.body.classList.remove("dark-mode");
    }
  });

  const botonDarkMode = document.querySelector(".dark-mode-boton");
  botonDarkMode.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");
  });
}

function eventListeners() {
  const mobilemenu = document.querySelector(".mobile-menu");
  mobilemenu.addEventListener("click", navegacionResponsive);

  // Muestra campos condicionales
  const mostrarContacto = document.querySelectorAll(
    'input[name="contacto[contacto]"]'
  );
  // recorremos el arreglo mostrarContacto con un foreach
  mostrarContacto.forEach((input) =>
    input.addEventListener("click", () => mostrarMetodosContacto(input.value))
  );
}
function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");

  // primera opcion cuando vas empezando
  //  if (navegacion.classList.contains("mostrar")) {
  //    navegacion.classList.remove("mostrar");
  //  } else {
  //    navegacion.classList.add("mostrar");
  //  }
  //segunda opcion cuando ya sepas
  navegacion.classList.toggle("mostrar");
}
function mostrarMetodosContacto(e) {
  const contactoDiv = document.querySelector("#contacto");
  if (e === "telefono") {
    contactoDiv.innerHTML = `
    <label for="telefono">Numero Telefonico</label>
    <input type="tel" placeholder="Tu telefono" id="telefono" name="contacto[telefono]">

    <p>Elija la fecha y la hora para la llamada</p>

    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="contacto[fecha]">
    <label for="hora">Hora:</label>
    <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
    `;
  } else {
    contactoDiv.innerHTML = `
    <label for="email">E-mail</label>
    <input type="email" placeholder="Tu E-mail" id="email" name="contacto[email]" required>
    `;
  }
}

function apagarAlerta() {
  const alerta = document.querySelector(".alerta");
  setTimeout(() => {
    if (alerta) {
      alerta.remove();
    }
  }, 4800);
}
