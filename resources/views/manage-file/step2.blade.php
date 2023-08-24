@extends('layouts.app')

@section('title', '定恆')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">步驟二：歸檔</span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            {{--            <h5 class="card-header">Table Basic</h5>--}}
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>名稱</th>
                            <th>大小</th>
                            <th>最後更新日期</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @for($i = 1;$i<=5;$i++)
                            <tr>
                                <td>
                                    Version
                                </td>
                                <td>-</td>
                                <td>
                                    2 Days ago
                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-sm-6">
                        {{--                        <button type="submit" class="btn btn-primary">下一步</button>--}}
                        <a class="btn btn-primary" href="{{ url('events/create') }}">新增路徑</a>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>名稱</th>
                            <th>刪除</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @for($i = 1;$i<=5;$i++)
                            <tr>
                                <td>/XXXX公司/案件A/開庭通知</td>
                                <td><i class="menu-icon tf-icons bx bx-minus-circle"></i></td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-sm-7">
                        {{--                        <button type="submit" class="btn btn-primary">下一步</button>--}}
                        <a class="btn btn-primary" href="{{ url('manage-files/step1') }}">上一步</a>
                        <a class="btn btn-primary" href="{{ url('manage-files/step3') }}">完成</a>
                    </div>
                </div>
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
