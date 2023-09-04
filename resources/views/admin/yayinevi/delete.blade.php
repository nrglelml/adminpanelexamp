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
                </div>
            </div>
        </div>
    </div>
@endsection
