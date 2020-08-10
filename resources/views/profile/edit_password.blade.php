@component('components.main')
    @slot('title')
        Editando mis contraseña
    @endslot

    {!! Form::model(auth()->user(), ['route' => 'profile.update_password', 'method' => 'put', 'files' => true]) !!}
        <div class="form-group">
            {!! Form::label('current_password', 'Contraseña actual') !!}
            {!! Form::password('current_password', [
                'placeholder' => 'Ingresa la contraseña actual',
                'class' => 'form-control '.(!empty($errors->first('current_password')) ? 'is-invalid' : '')]);
            !!}
            @error('current_password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Nueva Contraseña') !!}
            {!! Form::password('password', [
                'placeholder' => 'Ingresa la nueva contraseña',
                'class' => 'form-control '.(!empty($errors->first('password')) ? 'is-invalid' : '')]);
            !!}
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirmar nueva Contraseña') !!}
            {!! Form::password('password_confirmation', [
                'placeholder' => 'Confirma la nueva contraseña',
                'class' => 'form-control '.(!empty($errors->first('password_confirmation')) ? 'is-invalid' : '')]);
            !!}
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Actualizar
            </button>
            <a href="{{ route('profile.index') }}" class="btn btn-secondary">
                <i class="fas fa-undo"></i> Regresar
            </a>
        </div>
    {!! Form::close() !!}
@endcomponent
