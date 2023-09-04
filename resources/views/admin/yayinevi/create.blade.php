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
                            <h4 class="card-title">Yayınevi Ekle</h4>

                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.yayinevi.create.post')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Yayınevi Adı</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary pull-right">Yayınevi Ekle</button>

                                    <div class="card-title">
                                        <a id="my-button" href="{{route('admin.yayinevi.index')}}">Geri Dön</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
