@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            
            <h1>Crear empleado</h1>

            <div class="alert alert-primary" role="alert">Los campos con asteriscos(*) son obligatorios</div>

            <div>
          
            <form class="needs-validation" action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">
                @csrf

                @include('empleado.form', ['mode'=>'Guardar', 'dataAreas'=>$areas, 'dataRoles'=>$roles])

            
            </form>

            </div>

        </div>
    </div>
</div>
@endsection




