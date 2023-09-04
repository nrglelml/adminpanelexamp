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
                    @endif
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Yayınevi </h4>
                            <p class="card-category">{{$data[0]['name']}}</p>

                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.yayinevi.update',['id'=>$data[0]['id']])}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Yayınevi Adı</label>
                                            <input type="text"value="{{$data[0]['name']}}" name="name" class="form-control">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary pull-right">Yayınevini Düzenle</button>
                                    <div class="card-title">
                                        <a id="my-button" href="{{route('admin.yayinevi.index')}}">Geri Dön</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

