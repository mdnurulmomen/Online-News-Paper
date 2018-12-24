
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
                        <th>Categories</th>
                        <th>Phone</th>
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
                            @foreach($editor->editor_categories as $category)
                                {{ $category->name }},
                            @endforeach
                                {{--{{ var_dump($editor->editor_categories)}}--}}
                            {{--{{ $editor->editor_categories}}--}}
                            </td>
                            <td>{{ $editor->phone }}</td>
                            <td>
                                <a href="{{ route('admin.edit.editor', $editor->id) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                <a href="{{ route('admin.delete.editor', $editor->id) }}" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@stop