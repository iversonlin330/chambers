@extends('layouts.app')

@section('title', '定恆')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">待辦事項</span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            {{--            <h5 class="card-header">Table Basic</h5>--}}
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>帳號</th>
                        <th>頁面</th>
                        <th>行為</th>
                        <th>時間</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @for($i = 1;$i<=5;$i++)
                        <tr>
                            <td>abc@com</td>
                            <td>時數登陸</td>
                            <td>insert</td>
                            <td>2023/01/01 13:30:00</td>
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
