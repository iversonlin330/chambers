@extends('layouts.app')

@section('title', '定恆')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">建立事件</span></h4>
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
{{--                        <h5 class="mb-0">Basic Layout</h5>--}}
{{--                        <small class="text-muted float-end">Default label</small>--}}
                    </div>
                    <div class="card-body">
                        <form action="{{ url('events') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">客戶</label>
                                <div class="col-sm-10">
{{--                                    <select name="event_id" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">--}}
{{--                                        @foreach($events as $event)--}}
{{--                                            <option value="{{ $event->id }}">{{ $event->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
                                    <input
                                        name="customer"
                                        type="text"
                                        class="form-control"
                                        id="basic-default-company"
                                        placeholder="客戶"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">事由</label>
                                <div class="col-sm-10">
                                    <input
                                        name="event"
                                        type="text"
                                        class="form-control"
                                        id="basic-default-company"
                                        placeholder="事由"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">備註</label>
                                <div class="col-sm-10">
                                    <textarea name="note" class="form-control" id="exampleFormControlTextarea1"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">律師列表</label>
                                <div class="col-sm-10">
                                    @foreach($email_list as $email)
                                        <div class="form-check">
                                            <input name="email[]" class="form-check-input" type="checkbox" value="{{ $email }}" id="defaultCheck2" checked="">
                                            <label class="form-check-label" for="defaultCheck2">
                                                {{ $email }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">起始日期</label>
                                <div class="col-sm-10">
                                    <input
                                        name="start_time"
                                        class="form-control"
                                        type="datetime-local"
                                        value="{{ date('Y-m-d\TH:i:s') }}"
                                        id="html5-datetime-local-input"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">結束日期</label>
                                <div class="col-sm-10">
                                    <input
                                        name="end_time"
                                        class="form-control"
                                        type="datetime-local"
                                        value="{{ date('Y-m-d\TH:i:s') }}"
                                        id="html5-datetime-local-input"
                                    />
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">新增</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // 在這裡放置你的 JavaScript 代碼
        $(document).ready(function () {
            // 當「Toggle Sidebar」按鈕被點擊時，切換 Sidebar 的顯示狀態
            $('#toggle-sidebar-btn').click(function () {
                $('#sidebar').toggleClass('d-none');
                $('#main-content').toggleClass('col-md-9 col-md-12');
            });
        });
    </script>
@endsection
