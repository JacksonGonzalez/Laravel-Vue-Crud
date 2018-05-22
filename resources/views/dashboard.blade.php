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

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item" v-if="pagination.current_page > 1">
                        <a href="#" class="page-link" @click.prevent="changePage(pagination.current.page - 1)">
                            <span>Atras</span>
                        </a>
                    </li>

                    <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                        <a href="" class="page-link" @click.prevent="changePage(page)">
                            @{{page}}
                        </a>
                    </li>

                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a href="#" class="page-link" @click.prevent="changePage(pagination.current.page + 1)">
                            <span>Siguente</span>
                        </a>
                    </li>

                </ul>
            </nav>

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