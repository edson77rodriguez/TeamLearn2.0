@extends('dashboard')

@section('template_title')
    Roles
@endsection

@section('crud_content')
<div class="container py-5">
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <span id="card_title">{{ __('Roles') }}</span>
            <div class="float-right">
                <button class="btn btn-dark me-3" data-bs-toggle="modal" data-bs-target="#createRolModal">
                    {{ __('Create New') }}
                </button>
            </div>
        </div>
    </div>


                    <div class="container mt-4">
    <div class="row">
        @foreach ($roles as $rol)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $rol->rol}}</h5>
                        <p class="card-text"><strong>Id:</strong> {{ $rol->id }}</p>

                        <div class="d-flex justify-content-between">
                        <button class="btn btn-info me-2 p-1" data-bs-toggle="modal" data-bs-target="#viewRolModal{{ $rol->id }}">Ver</button>
                            <button class="btn btn-primary me-2 p-1" data-bs-toggle="modal" data-bs-target="#editRolModal{{ $rol->id }}">Editar</button>
                            <form action="{{ route('roles.destroy', $rol->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $rol->id }}')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

                    <!-- Modal Editar Persona -->
                    <div class="modal fade" id="editRolModal{{ $rol->id }}" tabindex="-1" aria-labelledby="editPersonaModalLabel{{ $rol->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editRolModalLabel{{ $rol->id }}">Editar Rol</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('roles.update', $rol->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="rol{{ $rol->id }}" class="form-label">Rol</label>
                                            <input type="text" name="rol" id="rol{{ $rol->id }}" value="{{ old('rol', $rol->rol) }}" class="form-control" required>
                                        </div>

                                       
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Crear Persona -->
    <div class="modal fade" id="createRolModal" tabindex="-1" aria-labelledby="createPersonaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRolModalLabel">Crear</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('roles.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <input type="text" name="rol" id="rol" class="form-control" required>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KF6o/kJF/b7ICQ1Zfs0cQ45oM0v4lL+SzR0t4i0p54K/xY8q3jOAV5tQ9l" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/alertifyjs/build/alertify.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs/build/css/alertify.min.css"/>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Eliminar',
            text: '¿Estás seguro de que deseas eliminar esta rol?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.createElement('form');
                form.method = 'POST'; 
                form.action = '/roles/' + id;/// aqui se cambia el nombre de la vista, aqui se llama tipo pagos
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
    function RegistroExitoso() {
        Swal.fire({
            icon: 'success',
            title: 'Registro exitoso',
            text: 'Tu registro ha sido exitoso',
            timer: 1300,
            showConfirmButton: false
        });
    }
    function cambio() {
        Swal.fire({
            icon: 'success',
            title: 'cambio generado',
            text: ' ',
            timer: 1400,
            showConfirmButton: false
        });
    }
</script>

@if(session('register'))
    <script>
        RegistroExitoso();
    </script>
@endif
@if(session('modify'))
    <script>
        cambio();
    </script>
@endif
@if(session('destroy'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Eliminado',
            text: 'El elemento ha sido eliminado exitosamente',
            timer: 1200,
            showConfirmButton: false
        });
    </script>
@endif
@endsection
