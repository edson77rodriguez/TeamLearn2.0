<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>TeamLearn - Proyectos</title>

  <!-- Favicons -->
  <link href="{{ asset('img/logo.jpeg') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
  <!-- Header -->
  <header id="header" class="header d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="{{ asset('img/logo.jpeg') }}" alt="TeamLearn">
        <h1 class="ms-2">TeamLearn</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="projects.html" class="active">Proyectos</a></li>
          <li><a href="profile.html">Perfil</a></li>
          <li><a href="notifications.html">Notificaciones</a></li>
          <li><a href="blog.html">Blog</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>

  <!-- Main Content -->
  <main id="main" class="main">
    <!-- Section: Proyectos -->
    <section id="projects" class="projects py-5">
      <div class="container">
        <div class="section-title text-center mb-5">
          <h2 class="fw-bold">Proyectos</h2>
          <p>Explora los proyectos en los que puedes participar o inspirarte.</p>
        </div>

        <!-- Project Cards -->
        <div class="row gy-4">
          <!-- Card 1 -->
          <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm border-0 h-100">
              <img src="{{ asset('img/project1.jpg') }}" class="card-img-top" alt="Proyecto 1">
              <div class="card-body">
                <h5 class="card-title">Proyecto 1</h5>
                <p class="card-text">Descripción breve del proyecto. Descubre más detalles y colabora.</p>
                <span class="badge bg-success">Activo</span>
              </div>
              <div class="card-footer d-flex justify-content-between align-items-center">
                <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                <small class="text-muted">5 días restantes</small>
              </div>
            </div>
          </div>

          <!-- Card 2 -->
          <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm border-0 h-100">
              <img src="{{ asset('img/project2.jpg') }}" class="card-img-top" alt="Proyecto 2">
              <div class="card-body">
                <h5 class="card-title">Proyecto 2</h5>
                <p class="card-text">Otro proyecto interesante para explorar y contribuir.</p>
                <span class="badge bg-warning text-dark">En Progreso</span>
              </div>
              <div class="card-footer d-flex justify-content-between align-items-center">
                <a href="#" class="btn btn-primary btn-sm">Ver más</a>
                <small class="text-muted">10 días restantes</small>
              </div>
            </div>
          </div>

          <!-- Card 3 -->
          <div class="col-lg-4 col-md-6">
            <div class="card shadow-sm border-0 h-100">
              <img src="{{ asset('img/project3.jpg') }}" class="card-img-top" alt="Proyecto 3">
              <div class="card-body">
                <h5 class="card-title">Proyecto 3</h5>
                <p class="card-text">Únete a un equipo dinámico y ayuda a llevar este proyecto a cabo.</p>
                <span class="badge bg-danger">Cerrado</span>
              </div>
              <div class="card-footer d-flex justify-content-between align-items-center">
                <a href="#" class="btn btn-secondary btn-sm disabled">Cerrado</a>
                <small class="text-muted">Finalizado</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer id="footer" class="footer py-4 bg-dark text-light">
    <div class="container text-center">
      <p>&copy; 2024 TeamLearn. Todos los derechos reservados.</p>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
