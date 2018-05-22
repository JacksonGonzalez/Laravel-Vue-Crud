@extends('app')

@section('content')
    <div id="crud" class="row">
        <div class="col-md-12 ">
            <h1 class="d-block">CRUD Laravel Y VueJs</h1>
        </div>
        <div class="col-md-7">
            <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#create">
                Nueva Tarea
            </a>
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tarea</th>
                        <th colspan="2">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="keep in keeps">
                        <td>@{{ keep.id }}</td>
                        <td>@{{ keep.keep }}</td>
                        <td class="10px">
                            <a href="#" class="btn btn-warning btn-sm text-white" v-on:click.prevent="editKeeps(keep)">Editar</a>
                        </td>
                        <td class="10px">
                            <a href="#" class="btn btn-danger btn-sm text-white" v-on:click.prevent="deleteKeeps(keep)">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>

            @include('create')
            @include('edit')
        </div>
        <div class="col-md-5">
            <pre>
                @{{ $data }}
            </pre>
        </div>
    </div>
@endsection