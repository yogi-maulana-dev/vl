@extends('backend.layouts.master')
@section('title', 'Data Access')
@section('css')

@endsection

@section('content')
<div class="row wrapper border-bottom page-heading">
    <div class="col-lg-10">
        <h2>@yield('title')</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('dashboard.index')}}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Keamanan</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>@yield('title')</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h4 class="font-weight-bold">@yield('title')</h4>
                    <div class="ibox-tools">
                        <div class="p-0 text-right">
                            <a href="{{route('m_access.index')}}" class="btn btn-success b-r-xl"><i
                                    class="fa fa-arrow-left"></i>&nbsp;
                                kembali</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div>
                        <p class="pl-3">Ubah Users : Administrator</p>
                    </div>
                    <div class="form-group row pl-3">
                        <label for="decompordis" class="col-md-2 col-form-label font-weight-bold ">Pilih User</label>
                        <div class="col-md-4">
                            <select class="select2 form-control">
                                <option></option>
                                <option value="Silpi">Silpi</option>
                                <option value="Juned">Juned</option>
                                <option value="Sifa">Sifa</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm" type="button">
                                <i class="fa fa-floppy-o"></i> Simpan
                            </button>
                        </div>

                    </div>
                    <div class="table-responsive m-3">
                        <table id="table1" class="table p-3">
                            <thead>
                                <tr>
                                    <th width="5%" class="align-middle">#</th>
                                    <th class="align-middle">Nama</th>
                                    <th class="align-middle">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Panji</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm" type="button">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Cahyono</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-secondary btn-sm" type="button">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        table = $('#table1').DataTable({
            pageLength: 10,
            responsive: true,
            "searching": false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                // { extend: 'copy' },
                // { extend: 'csv' },
                // { extend: 'excel', title: 'ExampleFile' },
                // { extend: 'pdf', title: 'ExampleFile' },

                // {
                //     extend: 'print',
                //     customize: function (win) {
                //         $(win.document.body).addClass('white-bg');
                //         $(win.document.body).css('font-size', '10px');
                //         $(win.document.thead).css('background:#1ab394', '10px');

                //         $(win.document.body).find('table')
                //             .addClass('compact')
                //             .css('font-size', 'inherit');
                //     }
                // }
            ]
        });
        $(".select2").select2({
            placeholder: "pilih user ....",
            allowClear: true
        });

    });
</script>
@endpush
