@extends('dashboard')

@section('template_title')
    Proyectos
@endsection

@section('crud_content')
    <div class="container py-5">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span id="card_title">{{ __('Proyectos') }}</span>
                <div class="float-right">
                    <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createProyectoModal">
                        {{ __('Crear Nuevo') }}
                    </button>
                </div>
            </div>
        </div>
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="container mt-4">
            <div class="row">
                @foreach ($proyectos as $proyecto)
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{ $proyecto->nombre }}</h5>
                                <p class="card-text"><strong>Descripción:</strong> {{ $proyecto->descripcion }}</p>
                                <p class="card-text"><strong>Estado:</strong> {{ $proyecto->estado->desc_estado ?? 'N/A' }}</p>
                                <p class="card-text"><strong>Responsable:</strong> {{ $proyecto->user->nom ?? 'N/A' }}</p>

                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewProyectoModal{{ $proyecto->id }}">Ver</button>
                                    @if(Auth::user()->rol_id == 1 || Auth::user()->rol->nom_rol == 'Administrador')
                                        <button class="btn btn-primary me-2 p-2" data-bs-toggle="modal" data-bs-target="#editProyectoModal{{ $proyecto->id }}">Editar</button>
                                    @endif
                                    <form id="delete-form-{{ $proyecto->id }}" action="" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        @if(Auth::user()->rol_id == 1 || Auth::user()->rol->nom_rol == 'Administrador')
                                            <button type="button" class="btn btn-sm btn-danger me-2 p-2" onclick="confirmDelete('{{ $proyecto->id }}')">Eliminar</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Ver Proyecto -->
                    <div class="modal fade" id="viewProyectoModal{{ $proyecto->id }}" tabindex="-1" aria-labelledby="viewProyectoModalLabel{{ $proyecto->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewProyectoModalLabel{{ $proyecto->id }}">Detalles del Proyecto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Nombre:</strong> {{ $proyecto->nombre }}</p>
                                    <p><strong>Descripción:</strong> {{ $proyecto->descripcion }}</p>
                                    <p><strong>Estado:</strong> {{ $proyecto->estado->desc_estado ?? 'N/A' }}</p>
                                    <p><strong>Responsable:</strong> {{ $proyecto->user->nom ?? 'N/A' }}</p>
                                    <p><strong>Imagen:</strong></p>
                                    @if ($proyecto->imagen)
                                        <img src="{{ asset('storage/' . $proyecto->imagen) }}" alt="Imagen del proyecto" class="img-fluid" style="max-width: 100%; height: auto;">
                                    @else
                                        <p>N/A</p>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Editar Proyecto -->
                    <div class="modal fade" id="editProyectoModal{{ $proyecto->id }}" tabindex="-1" aria-labelledby="editProyectoModalLabel{{ $proyecto->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProyectoModalLabel{{ $proyecto->id }}">Editar Proyecto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="nombre{{ $proyecto->id }}" class="form-label">Nombre del Proyecto</label>
                                            <input type="text" name="nombre" id="nombre{{ $proyecto->id }}" value="{{ old('nombre', $proyecto->nombre) }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="descripcion{{ $proyecto->id }}" class="form-label">Descripción</label>
                                            <input type="text" name="descripcion" id="descripcion{{ $proyecto->id }}" value="{{ old('descripcion', $proyecto->descripcion) }}" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="estado_id{{ $proyecto->id }}" class="form-label">Estado</label>
                                            <select name="estado_id" id="estado_id{{ $proyecto->id }}" class="form-control" required>
                                                @foreach($estados as $estado)
                                                    <option value="{{ $estado->id }}" {{ $proyecto->estado_id == $estado->id ? 'selected' : '' }}>
                                                        {{ $estado->desc_estado }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="user_id{{ $proyecto->id }}" class="form-label">Responsable</label>
                                            <select name="user_id" id="user_id{{ $proyecto->id }}" class="form-control" required>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" {{ $proyecto->user_id == $user->id ? 'selected' : '' }}>
                                                        {{ $user->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Modal Crear Proyecto -->
        <div class="modal fade" id="createProyectoModal" tabindex="-1" aria-labelledby="createProyectoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProyectoModalLabel">Crear Nuevo Proyecto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('proyectos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre_proyecto" class="form-label">Nombre del Proyecto</label>
                            <input type="text" class="form-control" id="nombre_proyecto" name="nombre_proyecto" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <select class="form-select" id="estado_id" name="estado_id" required>
                        <option>Selecciona un estado</option>
                        @foreach ($estados as $estado)
                        <option value="{{ $estado->id }}">{{ $estado->desc_estado }}</option>
                        @endforeach
                    </select>

                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_termino" class="form-label">Fecha de Término</label>
                            <input type="date" class="form-control" id="fecha_termino" name="fecha_termino" required>
                        </div>
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen</label>
                            <input type="file" class="form-control" id="imagen" name="imagen">
                        </div>
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Usuario</label>
                            <select class="form-select" id="user_id" name="user_id" required>
                                <option>Seleccion un responsable</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->ap }} {{ $user->am }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Proyecto</button>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KF6o/kJF/b7ICQ1Zfs0cQ45oM0v4lL+SzR0t4i0p54K/xY8q3jOAV5tQ9l" crossorigin="anonymous"></script>

    <script>
        function confirmDelete(proyectoId) {
            if (confirm("¿Estás seguro de que deseas eliminar este proyecto?")) {
                document.getElementById('delete-form-' + proyectoId).submit();
            }
        }
    </script>
@endsection
