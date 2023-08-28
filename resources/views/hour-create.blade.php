@extends('layouts.app')

@section('title', '定恆')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">時數登錄</span></h4>
        <div class="row">
            <!-- Basic Layout -->
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
{{--                        <h5 class="mb-0">Basic Layout</h5>--}}
{{--                        <small class="text-muted float-end">Default label</small>--}}
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#modalCenter">購買時數
                        </button>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('hours') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">項目</label>
                                <div class="col-sm-10">
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="basic-default-company"
                                        placeholder="項目"
                                    />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">承辦人</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="exampleFormControlSelect1"
                                            aria-label="Default select example">
                                        <option selected>主持律師</option>
                                        <option value="1">法務助理</option>
                                        <option value="2">法務</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">承辦起始日期</label>
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
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">承辦結束日期</label>
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
                                <label class="col-sm-2 col-form-label" for="basic-default-name">客戶名稱</label>
                                <div class="col-sm-10">
                                    <select class="selectpicker form-control" id="exampleFormControlSelect1"
                                            aria-label="Default select example" data-live-search="true">
                                        <option selected>案件A</option>
                                        <option value="1">案件B</option>
                                        <option value="2">案件C</option>
                                        <option value="3">案件D</option>
                                    </select>
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
    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">購買時數</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameWithTitle" class="form-label">客戶</label>
                            <select class="form-select" id="exampleFormControlSelect1"
                                    aria-label="Default select example">
                                <option selected>案件A</option>
                                <option value="1">案件B</option>
                                <option value="2">案件C</option>
                                <option value="3">案件D</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">增加時數</label>
                            <input
                                type="number"
                                id="emailWithTitle"
                                class="form-control"
                                placeholder="xxxx@xxx.xx"
                            />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
