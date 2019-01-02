
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
                    @foreach($allNews as $news)
                        <tr>
                            <td>{{$news->id}}</td>
                            <td>{{$news->category->name}}</td>
                            <td>{{ $news->title }}</td>
                            <td>{{ str_limit($news->description, 60) }}</td>
                            <td>
                                <input type="checkbox" @if($news->status==1) checked @endif disabled>Published
                                <input type="checkbox" @if($news->status==0) checked @endif disabled>Unpublished
                            </td>
                            <td>
                                <a href="{{ route('admin.edit.news', [$news->id]) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-fw fa-edit"></i></a>
                                <a href="{{ route('admin.delete.news', $news->id) }}" class="btn btn-icon btn-pill btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-fw fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination text-right">
            {{ $allNews->onEachSide(5)->links() }}
            </div>
        </div>
@stop