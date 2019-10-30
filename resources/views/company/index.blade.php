@extends('layouts.master')

@section('title') Company @endsection

@section('top')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('header') Company @endsection
@section('description') This is the details of your company @endsection

@section('top')
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{url('/')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"> Company</li>
</ol>
@endsection

@section('content')
    <div class="box">

        <div class="box-header">
            <h3 class="box-title">Your Company</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
            <form  id="form-company" method="post" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" >
                {{ csrf_field() }} {{ method_field('POST') }}


                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="1">
                    <input type="hidden" name="_method" value="PATCH" />

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $company->address }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $company->email }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>

                                <div class="form-group">
                                    <label>Key API</label>
                                    <input type="text" class="form-control" id="key_api" name="key_api" value="{{ $company->key_api }}" required>
                                    <span class="help-block with-errors"></span>
                                </div>

                                <div class="form-group">
                                    <label>Logo Company</label>
                                    <input type="file" class="form-control" id="logo" name="logo">
                                    <div class="img" style="margin-top: 20px">
                                        <img src="{{ asset('upload/logo/'.$company->logo) }}" style="width:100%; width:200px;">
                                    </div>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            @php
                            $qr = "{'url':'".url('/')."', 'key':'".$company->key_api."'}";
                            @endphp
                            <div class="col-md-6">
                                <img class="img-responsive img-thumbnail" src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl={{ $qr }}&choe=UTF-8" style="margin: 0 auto;display: block;">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                </div>

                <div class="modal-footer">
                    <a onclick="generateApi()" class="btn btn-default pull-left">Generate New Key</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
            <hr>
            
        </div>
        <!-- /.box-body -->
    </div>

    @php
    // Function generate the key
    function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = sha1($characters[rand(0, $charactersLength - 1)]);
        return $randomString;
    }
    @endphp

@endsection

@section('bot')

    <!-- DataTables -->
    <script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

    {{-- Validator --}}
    <script src="{{ asset('assets/validator/validator.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $('#form-company').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    url = "{{ url('company') . '/' }}" + id;
                    console.log(url);
                    $.ajax({
                        url : url,
                        type : "POST",

                        data: new FormData($("#form-company")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            swal({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });

        function generateApi() {
            console.log('test');
            document.getElementById("key_api").value = "{{ generateRandomString() }}";
        }
    </script>
@endsection
