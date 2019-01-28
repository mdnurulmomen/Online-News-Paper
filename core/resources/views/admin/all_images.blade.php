
@extends('admin.layout.app')
@section('contents')

    <h2 class="mb-4"> Image's List </h2>
    <div class="card mb-4">
        <div class="card-body">
            <table class="table table-hover text-center" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Image Id</th>
                    <th>Image Title </th>
                    <th>description</th>
                    <th>Status</th>
                    <th class="actions">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($allImages as $image)
                    <tr>
                        <td>{{ $image->id }}</td>
                        <td>{{ $image->title }}</td>
                        <td>{{ $image->description }}</td>
                        
                        <td>
                            <input type="checkbox" @if($image->status==1) checked @endif disabled>Published
                            <input type="checkbox" @if($image->status==0) checked @endif disabled>Unpublished
                        </td>
                        <td>
                            <a href="{{ route('admin.edit.image', [$image->id]) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit">
                                <i class="fa fa-fw fa-edit"></i>
                            </a>

                            <a data-toggle="modal" data-target="#myModal{{ $image->id }}" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Delete">
                                <i class="fa fa-fw fa-trash"></i>
                            </a>
                            
                        </td>
                    </tr>

                    <div class="modal fade" id="myModal{{ $image->id }}" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Confirmation</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <form action="{{ route('admin.delete.image', $image->id) }}" method="POST">
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
        {{ $allImages->onEachSide(5)->links() }}
        </div>
    </div>
@stop