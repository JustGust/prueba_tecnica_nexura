@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row-10">

            <div class="d-flex justify-content-between mt-3">
                <h3>Lista de empleados</h3>
                <a href="{{ route('empleado.create') }}" class="btn btn-primary"><i class="fa-solid fa-user-plus"></i><span class="ms-3">Crear</span></a>
            </div>

            @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col"><i class="fa-solid fa-user-large"></i><span class="ms-3">Nombre</span> </th>
                        <th scope="col"><i class="fa-solid fa-at"></i><span class="ms-3">Email</span></th>
                        <th scope="col"><i class="fa-solid fa-venus-mars"></i><span class="ms-3">Sexo</span></th>
                        <th scope="col"><i class="fa-solid fa-briefcase"></i><span class="ms-3">Area</span></th>
                        <th scope="col"><i class="fa-solid fa-envelope-open-text"></i><span class="ms-3">Boletin</span></th>
                        <th scope="col">Modificar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($empleados as $empleado)
                    <tr>
                        <td>{{$empleado->nombre}}</td>
                        <td>{{$empleado->email}}</td>

                        @if($empleado->sexo == 'M')
                        <td><span class="badge rounded-pill bg-success">Masculino</span></td>
                        @else
                        <td><span class="badge rounded-pill bg-primary">Femenino</span></td>
                        @endif

                        <td>{{$empleado->area_nombre}}</td>

                        @if($empleado->boletin == 1)
                        <td>Si</td>
                        @else
                        <td>No</td>
                        @endif

                        <td>
                            <a class="btn btn-outline-primary" href="{{ url('/empleado/'.$empleado->id.'/edit') }}"><i class="fa-solid fa-user-pen"></i></i></a>
                        </td>

                        <td>
                            <form action="{{ url('/empleado/'.$empleado->id) }}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" onclick="return confirm('¿Deseas eliminar este registro?')" class="butt btn btn-outline-danger"><i class="fa-solid fa-user-xmark"></i></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            {!! $empleados->links() !!}

        </div>
    </div>
</div>
@endsection