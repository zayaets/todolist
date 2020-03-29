@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a href="{{ route('list_items') }}" class="btn btn-secondary mb-3">Back</a>
                <div class="card">
                    <div class="card-header">Edit Task</div>

                    <div class="card-body">

                        @if(isset($session_message))
                            <div class="alert alert-{{ ($session_message['status'] == 1) ? 'success' : 'danger'}}">{{ $session_message['text'] }}</div>
                        @endif

                        {{--@if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif--}}


                        <form action="{{ route('update_item', ['item' => $item->id]) }}" method="post">
                            @csrf

                            @if(isset($tags))
                                <div class="form-group row">
                                    <div class="col-sm-2">Tags</div>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            @foreach($tags as $key => $value)
                                                <div class="col-sm-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="tags[]" id="tag-{{ $key }}" class="form-check-input" value="{{ $value->id }}"
                                                            @foreach($item->tags as $tag)
                                                                @if($tag->text == $value->text)
                                                                    checked
                                                                @endif
                                                            @endforeach
                                                                >
                                                        <label for="tag-{{ $key }}" class="form-check-label">{{ $value->text }}</label>
                                                        @error('tags[]')
                                                        <div class="text-danger"><small>{{ $message }}</small></div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif


                            <div class="form-group row">
                                <label for="text" class="col-sm-2 col-form-label mt-0">Custom tags</label>
                                <div class="col-sm-10">
                                    <input type="text" name="custom_tags" id="text" class="form-control" placeholder="For example: important; tomorrow; birthdayparty; shopping;" value="{{ old('custom_tags', '') }}">
                                    @error('custom_tags')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row align-items-center">
                                <label for="text" class="col-sm-2 col-form-label mt-0">Task</label>
                                <div class="col-sm-10">
                                    <input type="text" name="text" id="text" class="form-control" value="{{ $item->text ?? old('text', '') }}">
                                    @error('text')
                                    <div class="text-danger"><small>{{ $message }}</small></div>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
