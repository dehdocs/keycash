@extends('proposal::template.html')
@section('title')
    Criando Proposta
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Criando nova Proposta</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{route('save-proposal')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="col-md-12">
                            <h4>Dados Pessoais</h4>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" />
                            @if($errors->has('name'))
                                <span class="error">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" name="cpf" />
                            @if($errors->has('cpf'))
                                <span class="error">{{$errors->first('cpf')}}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-8">
                            <label for="profession">Profissão</label>
                            <input type="text" class="form-control" name="profession" />
                            @if($errors->has('profession'))
                                <span class="error">{{$errors->first('profession')}}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            <label for="address">Logradoro</label>
                            <input type="text" class="form-control" name="address" />
                            @if($errors->has('address'))
                                <span class="error">{{$errors->first('address')}}</span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <h4>Fotos</h4>
                            <div class="form-group col-md-12">
                                <input type="file" name="photos[]" multiple />
                                @if($errors->has('photos'))
                                    <span class="error">{{$errors->first('photos')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="button btn-success">Enviar Proposta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop