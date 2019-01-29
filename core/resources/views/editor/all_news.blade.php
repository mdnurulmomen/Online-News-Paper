
@extends('editor.layout.app')
@section('contents')
        <h2 class="mb-4"> Post List </h2>
        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-hover text-center" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Category</th>
                        <th>News Title </th>
                        <th>Description</th>
                        <th>Status</th>
                        <th class="actions">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($allNews as $news)
                        <tr>
                            <td>{{$news->category->name}}</td>
                            <td>{{ $news->title }}</td>
                            <td>{{ str_limit($news->description, 60) }}</td>
                            <td>
                                <label class="checkbox-inline"><input type="radio" @if($news->status==1) checked @endif disabled>Published</label>
                                <label class="checkbox-inline"><input type="radio" @if($news->status==0) checked @endif disabled>Unpublished</label>
                            </td>
                            <td>
                                <a href="{{ route('editor.edit.news', [$news->id]) }}" class="btn btn-icon btn-pill btn-success" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@stop