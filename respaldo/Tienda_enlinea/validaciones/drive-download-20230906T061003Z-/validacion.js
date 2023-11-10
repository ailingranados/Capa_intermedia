document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form");
  form.addEventListener("submit", function (event) {
    const password1 = document.getElementById("password").value;
    const password2 = document.getElementById("password2").value;

    // Verificar si las contraseñas no son iguales
    if (password1 !== password2) {
      alert("Las contraseñas no coinciden.");
      event.preventDefault();
    }

    // Verificar si la contraseña cumple con los requisitos
    const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\W).{8,}$/;
    if (!passwordPattern.test(password1)) {
      alert(
        "La contraseña debe contener al menos una mayúscula, una minúscula y un carácter especial, y tener al menos 8 caracteres."
      );
      event.preventDefault();
    }
  });
});

