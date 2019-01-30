
@extends('admin.layout.app')
@section('contents')

        <h2 class="mb-4"> Editor List </h2>
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
                                <a href="{{ route('admin.edit_editor', $editor->id) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>

                                <a data-toggle="modal" data-target="#myModal{{ $editor->id }}" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-fw fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal{{ $editor->id }}" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Confirmation</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <form action="{{ route('admin.delete_editor', $editor->id) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <div class="modal-body">
                                            <p>Are You Sure ??</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Yes</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination text-right">
                {{ $editors->onEachSide(5)->links() }}
            </div>
        </div>
@stop