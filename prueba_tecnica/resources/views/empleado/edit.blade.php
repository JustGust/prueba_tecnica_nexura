@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            
            <h1>Editar empleado</h1>

            <div class="alert alert-primary" role="alert">Los campos con asteriscos(*) son obligatorios</div>

            <div>
          
            <form class="needs-validation" action="{{ url('/empleado/'.$empleado->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                {{method_field('PATCH')}}

                @include('empleado.form', ['mode'=>'Editar', 'dataAreas'=>$areas, 'dataRoles'=>$roles])

            
            </form>

            </div>

        </div>
    </div>
</div>
@endsection