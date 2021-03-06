@extends('admin.layout')

@section('header')
    <h1>
        USUARIOS
        <small>Listado</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Usuarios</li>
    </ol>
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Listado de usuarios</h3>

            <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="users-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->enable)
                                    <span class="label label-success">Habilitada</span>
                                @else
                                    <span class="label label-danger">Inhabilitada</span>
                                @endif
                            </td>
                            <td>{{ $user->role_name}}</td>
                            <td>
                                @can(Permissions::VIEW_USERS)
                                    <a href="{{ route('admin.users.show', $user) }}"
                                       class="btn btn-xs btn-default">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endcan
                                @can(Permissions::UPDATE_USERS)
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="btn btn-xs btn-info">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
        <!-- /.box-body -->
    </div>
@endsection


@push('styles')

    <link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css">

@endpush

@push('scripts')
    <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $('#posts-table').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@endpush
