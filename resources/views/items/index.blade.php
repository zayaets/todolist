@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>


                    <div class="card-body px-md-3">
                        <div class="btn-toolbar mb-3">
                            @can('create')
                                <a href="{{ route('create_item') }}" class="btn btn-primary float-left">New</a>
                            @endcan
                        </div>


                        @if($items->count())
                            @if(isset($tag))
                                <div class="alert alert-info">All records which contain tag <strong>#{{ $tag }}</strong> are displaying. <a href="{{ route('list_items') }}" class="link link-info d-block">Show All Records</a></div>
                            @endif
                            <div class="table-responsive-sm">
                                <table class="table">
                                    <thead>
                                    <tr  class="text-center">
                                        <th scope="col">@sortablelink('status', 'Status')</th>
                                        <th scope="col">@sortablelink('text', 'Task')</th>
                                        <th scope="col">{{--Tags <a href="{{ route('list_items') }}" class="link link-info d-block">Show All Tags</a>--}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            {{--                                            <th scope="row">{{ $item->id }}</th>--}}
                                            <td class="text-center">
                                                @if($item->status == 0)
                                                    <i class="far fa-circle"style="color: rgba(0,0,0,0.2); font-size: 20px;"></i>
                                                @else
                                                    {{--<i class="far fa-check-circle" style="color: green; font-size: 30px;"></i>--}}
                                                    {{--<i class="fas fa-check-circle" style="color: green; font-size: 20px;"></i>--}}
                                                    <i class="fas fa-check" style="color: green; font-size: 20px;"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="{{ ($item->status == 1) ? 'completed' : '' }}">{{ $item->text }}</div>
                                                @if($item->tags->count())
                                                    @foreach($item->tags as $tag)
                                                        <a href="{{ route('list_items', ['tag' => $tag->text]) }}" class="badge badge-primary text-light">{{ $tag->text }}</a>
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td>
                                                <div class="row justify-content-start">
                                                    <div class="col-xs-8 col-sm-6 col-md-3 mb-2 mb-md-1 pr-2 px-md-2">
                                                        <form action="{{ route('item_done', ['item' => $item->id]) }}" method="post">
                                                            @csrf
                                                            <button type="submit"class="btn btn-success btn-sm btn-block text-light">
                                                                <i class="far fa-check-square"></i>
                                                                {{--<i class="fas fa-check-circle"></i>--}}
                                                                {{--<i class="far fa-check-circle"></i>--}}
                                                                {{--<i class="fas fa-check-square"></i>--}}
                                                                {{--Done--}}
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="col-xs-8  col-sm-6 col-md-3 mb-2 mb-md-1 pr-2 px-md-2">
                                                        <form action="{{ route('item_undone', ['item' => $item->id]) }}" method="post">
                                                            @csrf
                                                            <button type="submit"class="btn btn-secondary btn-sm btn-block text-light">
                                                                <i class="fas fa-undo"></i>
                                                                {{--<i class="fas fa-undo-alt"></i>--}}
                                                                {{--Undo--}}
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="col-xs-8  col-sm-6 col-md-3 mb-2 mb-md-1 pr-2 px-md-2">
                                                        <a href="{{ route('edit_item', ['item' => $item->id]) }}" class="btn btn-info btn-sm btn-block text-light">
                                                            <i class="far fa-edit"></i>
                                                            {{--<i class="fas fa-edit"></i>--}}
                                                            {{--Edit--}}
                                                        </a>
                                                    </div>
                                                    <div class="col-xs-8  col-sm-6 col-md-3 mb-2 mb-md-1 pr-2 px-md-2">
                                                        <form action="{{ route('delete_item', ['item' => $item->id]) }}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning btn-sm btn-block">
                                                                <i class="far fa-trash-alt"></i>
                                                                {{--<i class="fas fa-trash-alt"></i>--}}
                                                                {{--Delete--}}
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>

                                {!! $items->appends(request()->except('page'))->render() !!}
                            </div>



                            {{--<ul class="list-group">
                                @foreach($items as $item)
                                    <li class="list-group-item">
                                        @if($item->status == 0)
                                            <i class="far fa-square"></i>
                                        @else
                                            <i class="fas fa-check-square"></i>
                                        @endif
                                        {{ $item->text }}

                                        @if (isset($item->tags))
                                            @foreach($item->tags as $key => $tag)
                                                <a href="#" class="badge badge-primary" style="/*background-color: --}}{{--{{ $colors[array_rand($colors)] }}--}}{{--;*/">{{ $tag->text }}</a>
                                            @endforeach
                                        @endif




                                        <div class="btn-group float-right">
                                            <form action="{{ route('item_done', ['item' => $item->id]) }}" method="post">
                                                @csrf
                                                <button type="submit"class="btn btn-success text-light">Done</button>
                                            </form>

                                            <form action="{{ route('item_undone', ['item' => $item->id]) }}" method="post">
                                                @csrf
                                                <button type="submit"class="btn btn-secondary text-light">Undone</button>
                                            </form>

                                            <a href="{{ route('edit_item', ['item' => $item->id]) }}" class="btn btn-info text-light">Edit</a>

                                            <form action="{{ route('delete_item', ['item' => $item->id]) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-warning">Delete</button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>--}}
{{--                            {{ $items->links() }}--}}
                        @endif




                        {{--@if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!--}}



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
