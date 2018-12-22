
@extends('admin.layout.app')
@section('contents')

        <h2 class="mb-4"> Employee List </h2>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-hover text-center" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Username </th>
                        <th>Email</th>
                        <th>Picture</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th class="actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($editors as $editor)
                        <tr>
                            <td>{{$editor->firstname}} {{$editor->lastname}}</td>
                            <td>{{ $editor->username }}</td>
                            <td>{{ $editor->email }}</td>
                            <td>
                                <img src="{{ asset('assets/editor/images/'.$editor->picpath) }}" class="img-thumbnail" alt="No Image" height="100" width="100">
                            </td>
                            <td>{{ $editor->phone }}</td>
                            <td>{{ $editor->address }} {{$editor->city}} {{ $editor->state }} {{ $editor->country }}</td>
                            <td>
                                <a href="{{ route('admin.edit.employee', [$editor->id, 'editor']) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                <a href="{{ route('admin.delete.employee', [$editor->id, 'editor']) }}" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    @foreach($reporters as $reporter)
                        <tr>
                            <td>{{$reporter->firstname}} {{$reporter->lastname}}</td>
                            <td>{{ $reporter->username }}</td>
                            <td>{{ $reporter->email }}</td>
                            <td>
                                <img src="{{ asset('assets/reporter/images/'.$reporter->picpath) }}" class="img-thumbnail" alt="No Image" height="100" width="100">
                            </td>
                            <td>{{ $reporter->phone }}</td>
                            <td>{{ $reporter->address }} {{$reporter->city}} {{ $reporter->state }} {{ $reporter->country }}</td>
                            <td>
                                <a href="{{ route('admin.edit.employee', [$reporter->id, 'reporter']) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                <a href="{{ route('admin.delete.employee', [$reporter->id, 'reporter']) }}" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@stop