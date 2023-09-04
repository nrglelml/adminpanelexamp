@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Yazarlar</h4>
                            <p class="card-category"> Burada kayıtlı olan yazarlar listesini bulabilirsiniz</p>
                        </div>
                        <div class="card-body">
                            <div class="card-content table-responsive">
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
                                        color: white;
                                        border: none;
                                        border-radius: 5px;
                                        cursor: pointer;
                                    }
                                </style>
                                <table class="table">
                                    <thead class="text-primary">
                                    <tr>
                                        <th>Yazar İsmi</th>
                                        <th>Yazar ismini Düzenle</th>
                                        <th>Yazarı Sil</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($data as $key =>$value)
                                        <tr>
                                            <td>{{$value['name']}}</td>
                                            <td><a href="{{route('admin.yazar.edit',['id'=>$value['id']])}}">Duzenle</a> </td>
                                            <td><a href="{{route('admin.yazar.delete',['id'=>$value['id']])}}">Sil</a> </td>
                                        </tr>
                                    @endforeach
                                    <td id="button-cell" class="bottom-right"></td>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3" id="my-button"><a href="{{route('admin.yazar.create')}}">Yazar Ekle</a></td>
                                    </tr>
                                    </tfoot>

                                </table>

                                {{$data->links()}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
