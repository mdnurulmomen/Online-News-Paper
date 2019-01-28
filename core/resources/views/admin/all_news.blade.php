
@extends('admin.layout.app')
@section('contents')

        <h2 class="mb-4"> News List </h2>
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

                                <a data-toggle="modal" data-target="#myModal{{$news->id}}" class="btn btn-icon btn-pill btn-danger delete_button" data-toggle="tooltip" title="delete">
                                    <i class="fa fa-fw fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <div id="myModal{{$news->id}}" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <form action="{{route('admin.delete.news',$news->id)}}" method="POST">
                                    @method('delete')    
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Confirmation</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <p>Are You Sure ??</p>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Yes</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination text-right">
            {{ $allNews->onEachSide(5)->links() }}
            </div>
        </div>

  

@stop

