@extends('layouts.app')

@section('title', '定恆')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">xx案件費用紀錄</span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            {{--            <h5 class="card-header">Table Basic</h5>--}}
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>項目</th>
                        <th>金額</th>
                        <th>附檔(路徑)</th>
                        <th>編輯</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @for($i = 1;$i<=5;$i++)
                        <tr>
                            <td>A項目</td>
                            <td>1000</td>
                            <td>xxx路徑</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"
                                        ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                        >
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
