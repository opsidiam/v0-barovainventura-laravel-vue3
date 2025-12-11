@extends('admin.layouts.app')

@section('content')
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ $content->subject }}</h1>
            </div>

            <div class="card shadow mb-4">
                <div class="card-body">
                    @include('app.layouts.emails.head')
                    <tr>
                        <td align="center" valign="top" width="100%" style="background-color: #f7f7f7;" class="content-padding">
                            <center>
                                <table cellspacing="0" cellpadding="0" width="600" class="w320">
                                    <tr>
                                        <td>
                                            {!! $content->message !!}
                                        </td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                    </tr>
                    @include('app.layouts.emails.footer')
                </div>
            </div>
        </div>
    </div>
</div>

    <style>
        .email-preview {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin-top: 20px;
        }

        .email-preview table {
            margin: 0 auto;
        }
    </style>
@endsection
