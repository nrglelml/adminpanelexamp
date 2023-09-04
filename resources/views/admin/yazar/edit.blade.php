@extends('layouts.admin')
@section('content')
    <div class="content">
        <style>
            #button-cell {
                position: relative;
            }
            .bottom-right {
                text-align: right;
            }

            #my-button {
                position: absolute;
                bottom: 0;
                right: 0;
                margin: 20px;
                padding: 20px;
                color: purple;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
        </style>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    @if(session('status'))
                        <div class="alert alert-primary" role="alert">
                            {{session('status')}}
                        </div>

                    @elseif(session('error'))
                        <div class="alert alert-primary" role="alert">
                            {{session('error')}}
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Yazarı Düzenle</h4>
                            <p class="card-category">{{$data[0]['name']}}</p>

                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.yazar.update',['id'=>$data[0]['id']])}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" value="{{$data[0]['name']}}">
                                            <span class="material-input"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="bmd-label-floating">Yazarın Resmi</label><br>
                                        <form enctype="multipart/form-data"  action="{{route('admin.yazar.create.post')}}" method="post">
                                            @if($data[0]['image'])
                                                <img src="{{asset($data[0]['image'])}}" style="width: 120px; height: 120px">
                                            @endif
                                            <input  type="file" name="image"  >
                                            <span class="material-input"></span>
                                        </form>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary pull-left">Yazarı Düzenle</button>
                                <div class="card-title">
                                    <a id="my-button" href="{{route('admin.yazar.index')}}">Geri Dön</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection




