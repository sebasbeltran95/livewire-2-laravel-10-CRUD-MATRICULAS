<div>
    @section('title', 'Posts')
    <div class="container-fluid">
        <div class="row text-center mb-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1 class="display-4">CRUD Matriculas</h1>
                <button class="btn btn-primary rounded-circle " data-bs-toggle="modal"
                    data-bs-target="#modalCrearSlug">+</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm">
                        <thead>
                            <th colspan="9">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control"
                                    placeholder="Buscar..."
                                    wire:model="search">
                                </div>
                            </th>
                            <tr>
                                <th class="text-center">Estudiante</th>
                                <th class="text-center">Modulo</th>
                                <th class="text-center">Fecha de Publicacion</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($this->matriculas as $cat)
                                <tr>
                                    <td class="text-center">{{ $cat->estudiante }}</td>
                                    <td class="text-center">{{ $cat->modulo }}</td>
                                    <td class="text-center">{{ $cat->created_at }}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-sm btn-warning"
                                                wire:click="datacliente({{ $cat }})" data-bs-toggle="modal"
                                                data-bs-target="#Modaleditar"><i class="fas fa-user-edit"></i></button>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                wire:click="$emit('deletePost',{{$cat->id}})"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No hay registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $this->matriculas->links() }}
                </div>
            </div>
        </div>
        {{-- Modal crear post --}}
        <div class="modal fade" id="modalCrearSlug" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Matriculas</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="@error('estudiante') text-danger @enderror">Nombre Estudiante</label>
                            <input type="text" class="form-control @error('estudiante') text-danger @enderror" wire:model="estudiante">
                            <i class="text-danger">
                                @error('estudiante') {{ $message }} @enderror
                            </i>
                        </div>
                        <div class="form-group">
                            <label class="@error('modulo') text-danger @enderror">Modulo</label>
                            <input type="text" class="form-control @error('modulo') text-danger @enderror" wire:model="modulo">
                            <i class="text-danger">
                                @error('modulo') {{ $message }} @enderror
                            </i>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" wire:click='crear'>Registrar Matriculas</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Fin modal crear post --}}

        {{--  editar   --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="Modaleditar" tabindex="-1" wire:ignore.self>
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar Matriculas</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="@error('estudiantex') text-danger @enderror">Nombre Estudiante</label>
                                        <input type="text" class="form-control @error('estudiantex') text-danger @enderror" wire:model="estudiantex">
                                        <i class="text-danger">
                                            @error('estudiantex') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label class="@error('modulox') text-danger @enderror">Modulo</label>
                                        <input type="text" class="form-control @error('modulox') text-danger @enderror" wire:model="modulox">
                                        <i class="text-danger">
                                            @error('modulox') {{ $message }} @enderror
                                        </i>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" wire:click="actua">Editar
                                        Matriculas</button>
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  editar   --}}
    </div>
</div>
@push('js')
    <script>
        Livewire.on('ok', msj =>{
            Swal.fire(
                msj[0],
                msj[1],
                msj[2],
            )
        });
        livewire.on('deletePost', postId => {
            Swal.fire({
                title: "¿Estas Seguro?",
                text: "¿Desea Eliminar este registro?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "SI"
            }).then((result) => {
                if (result.isConfirmed) {
                    livewire.emitTo('matriculas', 'delete', postId);

                    Swal.fire({
                    title: "!Eliminado!",
                    text: "Se elimino la Categoria",
                    icon: "success"
                    });
                }
            });
        });
    </script>
@endpush