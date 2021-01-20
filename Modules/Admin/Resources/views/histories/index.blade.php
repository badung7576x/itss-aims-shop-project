@extends('admin::layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Lịch sử hoạt động</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-10 offset-1">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
{{--                            <div class="card-tools">{{$histories->links()}}</div>--}}
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                @foreach($histories as $key => $history)
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td>
                                            <i class="fas fa-caret-right fa-fw"></i>
                                            {{$key}}
                                        </td>
                                    </tr>
                                    <tr class="expandable-body">
                                        <td>
                                            <div class="p-0" style="">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <th width="20%">Hành động</th>
                                                        <th width="55%">Mô tả</th>
                                                        <th>Thời gian</th>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($history as $his)
                                                    <tr>
                                                        <td>{{HISTORY_STATUS_MESSAGES[$his->action_type]}}</td>
                                                        <td>{{$his->descriptions}}</td>
                                                        <td>{{$his->activated_at}}</td>
                                                    </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
    </div>
@endsection
