@extends('proposal::template.html')
@section('title')
    Lista de Propostas
@stop
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h2>Propostas</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($proposals as $proposal)
                            <tr>
                                <td>{{$proposal->id}}</td>
                                <td>{{$proposal->name}}</td>
                                <td>{{$proposal->cpf}}</td>
                                <td>
                                    <a href="{{route('proposal-view',['id' => $proposal->id])}}">Ver</a>
                                    /
                                    <a href="{{route('proposal-edit',['id' => $proposal->id])}}">Editar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$proposals->render()}}
                </div>

            </div>
        </div>
    </div>
@stop
