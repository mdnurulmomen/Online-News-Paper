
@extends('admin.layout.app')
@section('contents')

        <h2 class="mb-4"> Post List </h2>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-hover text-center" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>News Id</th>
                        <th>Category Name</th>
                        <th>News Title </th>
                        <th>Description</th>
                        <th>Status</th>
                        <th class="actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->category->name}}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ str_limit($post->description, 60) }}</td>
                            <td>
                                <input type="checkbox" @if($post->status==1) checked @endif disabled>Published
                                <input type="checkbox" @if($post->status==0) checked @endif disabled>Unpublished
                            </td>
                            <td>
                                <a href="{{ route('admin.edit.post', [$post->id]) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                <a href="{{ route('admin.delete.post', $post->id) }}" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination text-right">
            {{ $posts->onEachSide(5)->links() }}
            </div>
        </div>
@stop