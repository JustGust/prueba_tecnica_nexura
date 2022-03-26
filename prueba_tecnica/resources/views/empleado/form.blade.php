
@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach( $errors->all() as $error)
        <li>{{ $error}}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif



<div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Nombre completo*</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ isset($empleado->nombre)?$empleado->nombre:old('nombre') }}" placeholder="Nombre completo del empleado">
    </div>
</div>

<div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Correo electrónico*</label>
    <div class="col-sm-10">
        <input type="email" class="form-control" id="email" name="email" value="{{ isset($empleado->email)?$empleado->email:old('email') }}" placeholder="Correo electrónico">
    </div>
</div>

<div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">sexo*</label>
    <div class="col-sm-10">
    
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" id="sexo" value="M">
            Masculino
            </label>
        </div>
       
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sexo" value="F" id="sexo">
            Femenino
            </label>
        </div>
       
    </div>
</div>

<div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Área*</label>
    <div class="col-sm-10">

        <select class="form-select" aria-label="Default select example" name="area_id" id="area_id">

            @foreach($dataAreas as $area)
            <option value="{{$area->id}}">{{$area->nombre}}</option>
            @endforeach


        </select>
    </div>
</div>

<div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Descripción*</label>
    <div class="col-sm-10">
        <textarea class="form-control" placeholder="Descripción de la experiencia del empleado" id="descripcion" name="descripcion" style="height: 100px">{{ isset($empleado->descripcion)?$empleado->descripcion:old('descripcion') }}</textarea>

        <div class="form-check mb-4 mt-2">
            <input class="form-check-input" type="checkbox" value="1" id="boletin" name="boletin">
            <label class="form-check-label" for="flexCheckChecked">
                Deseo recibir boletín informativo
            </label>
        </div>

    </div>
</div>

<div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Roles*</label>
    <div class="col-sm-10">

        @foreach($dataRoles as $role)

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{$role->id}}" id="role_id" name="role_id">
            <label class="form-check-label" for="flexCheckDefault">
                {{ $role->nombre }}
            </label>
        </div>

        @endforeach

    </div>
</div>


<div class="col-sm-10 mt-3">
    <button type="submit" class="btn btn-primary">{{$mode}}</button>
</div>