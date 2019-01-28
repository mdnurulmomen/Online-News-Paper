
@extends('editor.layout.app')
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
                            <a href="{{ route('editor.edit.image', [$image->id]) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit">
                                <i class="fa fa-fw fa-edit"></i>
                            </a>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
        <div class="pagination text-right">
        {{ $allImages->onEachSide(5)->links() }}
        </div>
    </div>
@stop