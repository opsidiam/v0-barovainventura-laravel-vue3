@extends('app.layouts.app')
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <div class="container-fluid">
                <h1 class="h3 mb-2 text-gray-800">{{__('user.login_history')}}</h1>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableServicesList" width="99%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>{{__('user.login_history_table.login_time')}}</th>
                                    <th>{{__('user.login_history_table.login_ip')}}</th>
                                    <th>{{__('user.login_history_table.user_agent')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($login_history ?? [] as $history)
                                    <tr>
                                        <td>{{ $history->created_at }}</td>
                                        <td>{{ $history->login_ip }}</td>
                                        <td>{{ $history->user_agent }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
