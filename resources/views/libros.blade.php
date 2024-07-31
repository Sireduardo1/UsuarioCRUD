<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Boxicons CSS -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Dashboard</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
  <!-- Enlace al archivo CSS de Bootstrap -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/light-bootstrap-dashboard.css?v=2.0.0') }}">
  <!-- Enlace a tu archivo de estilos personalizado -->
  <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />
  <!-- Icono del sitio -->
  <link rel="icon" href="{{ asset('img/biblioteca.ico') }}" type="image/x-icon">

  <style>
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(70% - 1rem);
        }
    </style>
</head>


<body>
  <div class="wrapper">
    <div class="sidebar" data-image="{{asset('img/sidebar-5.jpg')}}">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="http://www.creative-tim.com" class="simple-text">
            Library
          </a>
        </div>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('mostrar_estadisticas') }}">
              <i class="nc-icon nc-chart-pie-35"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="nc-icon nc-circle-09"></i>
              <p>User Profile</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('mostrar_libros') }}">
              <i class="nc-icon nc-notes"></i>
              <p>Book List</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('mostrar_usuarios') }}">
              <i class="nc-icon nc-notes"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <li>
            <a class="nav-link" href="">
              <i class="nc-icon nc-bell-55"></i>
              <p>Notifications</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg " color-on-scroll="500">
        <div class="container-fluid">
          <i class="bi bi-grid"></i>
          <i class='bx bx-sun' id="darkLight"></i>
          <a class="navbar-brand" href="#pablo"> Book List </a>
          <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
              <li class="nav-item">
                <a href="#" class="nav-link" data-toggle="dropdown">
                  <i class="nc-icon nc-palette"></i>
                  <span class="d-lg-none">Dashboard</span>
                </a>
              </li>
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <i class="nc-icon nc-planet"></i>
                  <span class="notification">5</span>
                  <span class="d-lg-none">Notification</span>
                </a>
                <ul class="dropdown-menu">
                  <a class="dropdown-item" href="#">Notification 1</a>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nc-icon nc-zoom-split"></i>
                  <span class="d-lg-block">&nbsp;Search</span>
                </a>
                <input type="text" placeholder="Busca un libro">
              </li>
            </ul>
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <span class="no-icon">Account</span>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="no-icon">Dropdown</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                  <div class="divider"></div>
                  <a class="dropdown-item" href="#">Separated link</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                               
                  <a id="navbarDropdownMenuLink" class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      Cerrar Sesion
                  </a>

                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                  </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                  <h4 class="card-title">LIBROS</h4>
                  <p class="card-category">Gestiona los libros en esta seccion</p>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#RegistrarUsuario">
                    Registrar Libro
                  </button>

                </div>
                <div class="card-body table-full-width table-responsive">
                  <table class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Categoria</th>
                        <th>Editorial</th>
                        <th>Isbn</th>
                        <th>Año publicado</th>
                        <th>Cantidad</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($libros as $libro)
                      <tr>
                        <td>{{ $libro->id }}</td>
                        <td>{{ $libro->titulo }}</td>
                        <td>{{ $libro->autor_id ? $libro->autor->nombre : 'N/A' }}</td>
                        <td>{{ $libro->categoria_id ? $libro->categoria->nombre_categoria : 'N/A' }}</td>
                        <td>{{ $libro->editorial_id ? $libro->editorial->nombre : 'N/A' }}</td>
                        <td>{{ $libro->isbn }}</td>
                        <td>{{ $libro->ano_publicacion }}</td>
                        <td>{{ $libro->cantidad }}</td>
                        </td>
                        <td>
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#EditarUsuario" onclick="modalEdit(event);"><i class="fas fa-pencil-alt"></i></button>
                          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#EliminarUsuario" id="eliminarLibro"><i class="fas fa-solid fa-trash"></i></button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Registro-->
      <div class="modal fade" id="RegistrarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Registrar Libros</h5>
              <button type="button" class="close" id="cerrarmodal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <form method="POST" action="{{ route('guardar_libro') }}" enctype="multipart/form-data" id="formregistrar">
                @csrf
                <div class="modal-flex">
                  <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required autocomplete="on">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="autor">Autor:</label>
                    <select id="autor_select" class="form-control" onchange="updateTextInput(this, 'autor')">
                      <option value="">--Seleccionar Autor--</option>
                      @foreach($autores as $autor)
                      <option value="{{ $autor->id }}">{{ $autor->nombre }}</option>
                      @endforeach
                    </select>
                    <input type="button" class="btn btn-primary mt-2" value="Agregar" onclick="toggleInput('autor')">
                    <input type="text" id="autor" name="autor" class="form-control mt-2" placeholder="Ingresar nuevo autor" style="display: none;">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="editorial">Editorial:</label>
                    <select id="editorial_select" class="form-control" onchange="updateTextInput(this, 'editorial')">
                      <option value="">--Seleccionar Editorial--</option>
                      @foreach($editoriales as $editorial)
                      <option value="{{ $editorial->id }}">{{ $editorial->nombre }}</option>
                      @endforeach
                    </select>
                    <input type="button" class="btn btn-primary mt-2" value="Agregar" onclick="toggleInput('editorial')">
                    <input type="text" id="editorial" name="editorial" class="form-control mt-2" placeholder="Ingresar nueva editorial" style="display: none;">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <select id="categoria_select" class="form-control" onchange="updateTextInput(this, 'categoria')">
                      <option value="">--Seleccionar Categoría--</option>
                      @foreach($categorias as $categoria)
                      <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                      @endforeach
                    </select>
                    <input type="button" class="btn btn-primary mt-2" value="Agregar" onclick="toggleInput('categoria')">
                    <input type="text" id="categoria" name="categoria" class="form-control mt-2" placeholder="Ingresar nueva categoría" style="display: none;">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" required autocomplete="on">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="ano_publicacion">Año de Publicación:</label>
                    <input type="date" class="form-control" id="ano_publicacion" name="ano_publicacion" required autocomplete="on">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" required autocomplete="on">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <div class="mb-3 d-flex justify-content-center align-items-center flex-column">
                      <input class="form-control-file" type="file" id="formFileMultiple" name="imagen" multiple required onchange="vistaPreviaRegistro()">
                      <br>
                      <div class="text-center mt-2">
                        <img id="imagenPrevia" src="#" alt="Vista previa de la imagen" style="max-width: 200px; max-height: 200px; display: none;">
                      </div>
                    </div>
                  </div>
                  <!-- Botón de guardar dentro del formulario -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="guardar" name="guardar" class="btn btn-primary">Guardar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- Modal edit -->
      <div class="modal fade" id="EditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Libro</h5>
              <button type="button" class="close" id="cerrarmodal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('actualizar_libro') }}" enctype="multipart/form-data" id="formedit">
                @csrf
                <div class="modal-flex">
                  <div class="form-group">
                    @foreach($libros as $libro)
                    <input type="hidden" name="id" value="{{$libro->id}}">
                    @endforeach
                    <label for="titulo">Titulo:</label>
                    <input type="text" class="form-control" id="tituloedit" name="tituloedit" required autocomplete="on">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="autor">Autor:</label>
                    <select style="display: none;" id="autoredit_select" class="form-control" onchange="updateTextInput(this, 'autoredit')">
                      <option value="">--Seleccionar Autor--</option>
                      @foreach($autores as $autor)
                      <option value="{{ $autor->id }}">{{ $autor->nombre }}</option>
                      @endforeach
                    </select>
                    <input type="button" class="btn btn-primary mt-2" value="Agregar" onclick="toggleInput('autoredit_select')">
                    <input type="text" id="autoredit" name="autoredit" class="form-control mt-2" placeholder="Ingresar nuevo autor">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="editorial">Editorial:</label>
                    <select id="editorialedit_select" class="form-control" style="display: none;" onchange="updateTextInput(this, 'editorialedit')">
                      <option value="">--Seleccionar Editorial--</option>
                      @foreach($editoriales as $editorial)
                      <option value="{{ $editorial->id }}">{{ $editorial->nombre }}</option>
                      @endforeach
                    </select>
                    <input type="button" class="btn btn-primary mt-2" value="Agregar" onclick="toggleInput('editorialedit_select')">
                    <input type="text" id="editorialedit" name="editorialedit" class="form-control mt-2" placeholder="Ingresar nueva editorial">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <select id="categoriaedit_select" class="form-control" style="display: none;" onchange="updateTextInput(this, 'categoriaedit')">
                      <option value="">--Seleccionar Categoría--</option>
                      @foreach($categorias as $categoria)
                      <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
                      @endforeach
                    </select>
                    <input type="button" class="btn btn-primary mt-2" value="Agregar" onclick="toggleInput('categoriaedit_select')">
                    <input type="text" id="categoriaedit" name="categoriaedit" class="form-control mt-2" placeholder="Ingresar nueva categoría">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" class="form-control" id="isbnedit" name="isbnedit" required autocomplete="on">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="ano_publicacion">Año de Publicación:</label>
                    <input type="date" class="form-control" id="ano_publicacionedit" name="ano_publicacionedit" required autocomplete="on">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="cantidad">Cantidad:</label>
                    <input type="number" class="form-control" id="cantidadedit" name="cantidadedit" required autocomplete="on">
                  </div>
                  <br>
                  <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <div class="mb-3 d-flex justify-content-center align-items-center flex-column">
                      <input class="form-control-file" type="file" id="formFileMultiple" name="imagenedit" multiple required onchange="vistaPreviaRegistro()">
                      <br>
                      <div class="text-center mt-2">
                        <img id="imagenPrevia" src="#" alt="Vista previa de la imagen" style="max-width: 200px; max-height: 200px; display: none;">
                      </div>
                    </div>
                  </div>
                  <!-- Botón de guardar dentro del formulario -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="actualizar" name="actualizar" class="btn btn-primary">Guardar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Eliminar-->
      <div class="modal fade" id="EliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Libro</h5>
              <button type="button" class="close" id="cerrarmodal" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('eliminar_libro') }}" enctype="multipart/form-data" id="formeliminar">
                @csrf
                <div class="form-group">
                  <label for="titulo">Titulo:</label>
                  @foreach($libros as $libro)
                  <input type="hidden" name="id_delete" value="{{$libro->id}}">
                  <input type="text" class="form-control" value="{{$libro->titulo}}" required disabled>
                  @endforeach
                </div>
                <br>
                <div class="form-group">
                  <label for="imagen">Imagen:</label>
                  <div class="mb-3 d-flex justify-content-center align-items-center flex-column">
                    <input class="form-control" type="file" id="formFileMultiple" multiple onchange="vistaPreviaRegistro()">
                    <br>
                    <div class="text-center mt-2">
                      <img id="imagenPrevia" src="#" alt="Vista previa de la imagen" style="max-width: 200px; max-height: 200px; display: none;">
                    </div>
                  </div>
                </div>
                <!-- Botón de guardar dentro del formulario -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" id="eliminar" name="eliminar" class="btn btn-primary">Eliminar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav>
            <ul class="footer-menu">
              <li>
                <a href="#">
                  Home
                </a>
              </li>
              <li>
                <a href="#">
                  Company
                </a>
              </li>
              <li>
                <a href="#">
                  Portfolio
                </a>
              </li>
              <li>
                <a href="#">
                  Blog
                </a>
              </li>
            </ul>
            <p class="copyright text-center">
              ©
              <script>
                document.write(new Date().getFullYear())
              </script>
              <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
            </p>
          </nav>
        </div>
      </footer>
    </div>
  </div>
</body>
<!-- jQuery -->
<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Tu propio script -->
<script src="{{ asset('js/script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.js"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="{{asset('js/plugins/bootstrap-switch.js')}}"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="{{asset('js/plugins/chartist.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="{{asset('js/light-bootstrap-dashboard.js?v=2.0.0')}} " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('js/demo.js')}}"></script>

</html>