@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Tutoriales</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                
            
                        @can('crear-tutorial')
                        <a class="btn btn-warning" href="{{ route('tutoriales.create') }}">Nuevo</a>
                        @endcan
            
                        <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                     
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Titulo</th>
                                    <th style="color:#fff;">Contenido</th>                                    
                                    <th style="color:#fff;">Acciones</th>                                                                   
                              </thead>
                              <tbody>
                            @foreach ($tutoriales as $tutorial)
                            <tr>
                                <td style="display: none;">{{ $tutorial->id }}</td>                                
                                <td>{{ $tutorial->titulo }}</td>
                                <td>{{ $tutorial->contenido }}</td>
                                <td>
                                    <form action="{{ route('tutoriales.destroy',$tutorial->id) }}" method="POST">                                        
                                        @can('editar-tutoriales')
                                        <a class="btn btn-info" href="{{ route('tutoriales.edit',$tutorial->id) }}">Editar</a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('borrar-tutorial')
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <!-- Ubicamos la paginacion a la derecha -->
                        <div class="pagination justify-content-end">
                            {!! $tutoriales->links() !!}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
