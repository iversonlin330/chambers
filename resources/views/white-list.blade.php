@extends('layouts.app')

@section('title', '定恆')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">白名單</span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                {{--                        <h5 class="mb-0">Basic Layout</h5>--}}
                {{--                        <small class="text-muted float-end">Default label</small>--}}
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#modalCenter">新增白名單
                </button>
            </div>
            {{--            <h5 class="card-header">Table Basic</h5>--}}
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Email</th>
                        <th>添加日期</th>
                        <th>編輯</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @for($i = 1;$i<=5;$i++)
                        <tr>
                            <td>abc@com</td>
                            <td>2023/01/01 13:30:00</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
{{--                                        <a class="dropdown-item" href="javascript:void(0);"--}}
{{--                                        ><i class="bx bx-edit-alt me-1"></i> Edit</a--}}
{{--                                        >--}}
                                        <a class="dropdown-item" href="javascript:void(0);"
                                        ><i class="bx bx-trash me-1"></i> Delete</a
                                        >
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">新增白名單</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailWithTitle" class="form-label">Email</label>
                            <input
                                type="email"
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
