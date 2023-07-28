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
                        <form action="{{ url('todos') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">客戶</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                                        <option selected>案件A</option>
                                        <option value="1">案件B</option>
                                        <option value="2">案件C</option>
                                        <option value="3">案件D</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">事由</label>
                                <div class="col-sm-10">
                                    <input
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
                                    <textarea class="form-control" id="exampleFormControlTextarea1"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">律師列表</label>
                                <div class="col-sm-10">
                                    @for($i=0;$i<=3;$i++)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" checked="">
                                        <label class="form-check-label" for="defaultCheck2">
                                            abc@com
                                        </label>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">起始日期</label>
                                <div class="col-sm-10">
                                    <input
                                        class="form-control"
                                        type="datetime-local"
                                        value="2021-06-18T12:30:00"
                                        id="html5-datetime-local-input"
                                    />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">結束日期</label>
                                <div class="col-sm-10">
                                    <input
                                        class="form-control"
                                        type="datetime-local"
                                        value="2021-06-18T12:30:00"
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
