const body = document.querySelector("body");
const darkLight = document.querySelector("#darkLight");
const sidebar = document.querySelector(".sidebar");
const submenuItems = document.querySelectorAll(".submenu_item");


function toggleInput(inputId) {
  var inputElement = document.getElementById(inputId);
  if (inputElement.style.display === 'none' || inputElement.style.display === '') {
      inputElement.style.display = 'inline';
      inputElement.required = true;
      document.getElementById('autor_select').disabled = true;
  } else {
      inputElement.style.display = 'none';
      inputElement.required = false;
      document.getElementById('autor_select').disabled = false;
  }
}

function updateTextInput(selectElement,inputId) {
  var selectedText = selectElement.options[selectElement.selectedIndex].text;
  var inputElement = document.getElementById(inputId);
  inputElement.value = selectedText;
  inputElement.style.display = 'inline';
  inputElement.required = true;
  document.getElementById('autor_select').disabled = true;
 
}

darkLight.addEventListener("click", () => {
  body.classList.toggle("dark");
  if (body.classList.contains("dark")) {
    document.setI;
    darkLight.classList.replace("bx-sun", "bx-moon");
  } else {
    darkLight.classList.replace("bx-moon", "bx-sun");
  }
});

submenuItems.forEach((item, index) => {
  item.addEventListener("click", () => {
    item.classList.toggle("show_submenu");
    submenuItems.forEach((item2, index2) => {
      if (index !== index2) {
        item2.classList.remove("show_submenu");
      }
    });
  });
});


//--------------------------------//
function modalEdit(evento) {
  console.log("funciona")
  var id_tabla = $(evento.target).parents("tr").find("td").eq(0).text().trim();
  var titulo_tabla = $(evento.target).parents("tr").find("td").eq(1).text().trim();
  // var imagen_tabla = $(evento.target).parents("tr").find("td").eq(2).find("img").attr("src").trim(); // Obtener la ruta de la imagen
  var autor_tabla = $(evento.target).parents("tr").find("td").eq(2).text().trim();
  var categoria_tabla = $(evento.target).parents("tr").find("td").eq(3).text().trim();
  var editorial_tabla = $(evento.target).parents("tr").find("td").eq(4).text().trim();
  var isbn_tabla = $(evento.target).parents("tr").find("td").eq(5).text().trim();
  var ano_publi_tabla = $(evento.target).parents("tr").find("td").eq(6).text().trim();
  // var estado_tabla = $(evento.target).parents("tr").find("td").eq().text().trim(); // Se cambia el índice al 5 para obtener el campo de estado
  var cantidad_tabla = $(evento.target).parents("tr").find("td").eq(7).text().trim();

  // Convertir el valor del estado de la tabla a un texto legible
  // var estadoLegible = estadotabla === 'Activo' ? '1' : '0'; // Si es 'Activo', asignar '1', de lo contrario, asignar '0'
  console.log(titulo_tabla)
  console.log(autor_tabla)
  console.log(categoria_tabla)
  // Llenar los campos del formulario de edición con los valores obtenidos
  $("#tituloedit").val(titulo_tabla);
  $("#autoredit").val(autor_tabla);
  $("#categoriaedit").val(categoria_tabla);
  $("#editorialedit").val(editorial_tabla);
  $("#isbnedit").val(isbn_tabla);
  $("#ano_publicacionedit").val(ano_publi_tabla);
  $("#cantidadedit").val(cantidad_tabla);
  

  // Establecer el estado seleccionado
  // $("#estadoedit").val(estadoLegible);

  // Mostrar la vista previa de la imagen
  // mostrarVistaPreviaEdicion(imagentabla);
}


function mostrarVistaPreviaEdicion(imagentabla) {
  var vistaPrevia = document.getElementById('vistaPreviaImagenEdit');

  if (imagentabla) {
    vistaPrevia.src = imagentabla;
    vistaPrevia.style.display = 'block'; // Mostrar la imagen
  } else {
    vistaPrevia.src = '#';
    vistaPrevia.style.display = 'none'; // Ocultar la imagen
  }
}

function vistaPreviaEdicion() {
  var archivoSeleccionado = document.getElementById('imagenedit').files[0];
  var vistaPrevia = document.getElementById('vistaPreviaImagenEdit');

  if (archivoSeleccionado) {
    var lector = new FileReader();

    lector.onload = function(event) {
      vistaPrevia.src = event.target.result;
      vistaPrevia.style.display = 'block';
    };

    lector.readAsDataURL(archivoSeleccionado);
  } else {
    vistaPrevia.src = '#';
    vistaPrevia.style.display = 'none';
  }
}



function activarboton(event) {
  $("#idedit").prop("disabled", false);
}


//--------------------------//
function vistaPreviaRegistro() {
  var input = document.getElementById('formFileMultiple');
  var vistaPrevia = document.getElementById('imagenPrevia');

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      vistaPrevia.src = e.target.result;
      vistaPrevia.style.display = 'block';
    }

    reader.readAsDataURL(input.files[0]);
  }
}

document.getElementById('formFileMultiple').addEventListener('change', function() {
  vistaPreviaRegistro();
});



//--------------------------//
//sweetaler2 de registrar 
document.getElementById('formregistrar').addEventListener('submit', function(event) {
  event.preventDefault();

  // Obtener el formulario y los datos del mismo
  const form = event.target;
  const formData = new FormData(form);

  // Hacer una solicitud POST al endpoint de Laravel
  axios.post('/guardar-libro', formData)
      .then(function(response) {
          // Mostrar una alerta SweetAlert2 si la película se guardó correctamente
          Swal.fire({
              title: 'Éxito',
              text: response.data.message,
              icon: 'success',
              confirmButtonText: 'Aceptar'
          }).then((result) => {
              if (result.isConfirmed) {
                  location.href = "/"; // Redireccionar a la página de películas
              }
          });
      })
      .catch(function(error) {
          // Manejar errores
          console.error('Error al guardar el  libro:', error);
          Swal.fire({
              title: 'Error',
              text: 'Error al guardar el libro.',
              icon: 'error',
              confirmButtonText: 'Aceptar'
          });
      });
});

//sweetaler2 edit 
document.getElementById('formedit').addEventListener('submit', function(event) {
  event.preventDefault();

  // Obtener el formulario y los datos del mismo
  const form = event.target;
  const formData = new FormData(form);

  // Hacer una solicitud POST al endpoint de Laravel
  axios.post(form.action, formData)
      .then(function(response) {
          // Mostrar una alerta SweetAlert2 si la película se actualizó correctamente
          Swal.fire({
              title: 'Éxito',
              text: response.data.message,
              icon: 'success',
              confirmButtonText: 'Aceptar'
          }).then((result) => {
              if (result.isConfirmed) {
                  location.href = "/"; // Redireccionar a la página de películas
              }
          });
      })
      .catch(function(error) {
          // Manejar errores
          console.error('Error al actualizar la película:', error);
          Swal.fire({
              title: 'Error',
              text: 'Error al actualizar la película.',
              icon: 'error',
              confirmButtonText: 'Aceptar'
          });
      });
});

//--------------------------//
//sweetaler2 de eliminar 
document.getElementById('formeliminar').addEventListener('submit', function(event) {
  event.preventDefault();

  // Obtener el formulario y los datos del mismo
  const formData = new FormData(this);
  const id_delete = formData.get('id_delete');

  // Hacer una solicitud DELETE al endpoint de Laravel
  axios.delete('/eliminar-libro', {data:{id_delete:id_delete}})
      .then(function(response) {
          // Mostrar una alerta SweetAlert2 si la película se guardó correctamente
          Swal.fire({
              title: 'Éxito',
              text: response.data.message,
              icon: 'success',
              confirmButtonText: 'Aceptar'
          }).then((result) => {
              if (result.isConfirmed) {
                  location.href = "/"; // Redireccionar a la página de películas
              }
          });
      })
      .catch(function(error) {
          // Manejar errores
          console.error('Error al eliminar el  libro:', error);
          Swal.fire({
              title: 'Error',
              text: 'Error al eliminar el libro.',
              icon: 'error',
              confirmButtonText: 'Aceptar'
          });
      });
});