@extends('layouts.app')

@section('title', '定恆')

@section('content')
    <div id="app">
        <h1>Welcome to My Website</h1>
        <button class="btn btn-primary" id="toggle-sidebar-btn">Toggle Sidebar</button>

        <div class="main-content">
            <!-- Your main content here -->
        </div>
    </div>
@endsection
@section('script')
    <script>
        // 在這裡放置你的 JavaScript 代碼
        $(document).ready(function() {
            // 當「Toggle Sidebar」按鈕被點擊時，切換 Sidebar 的顯示狀態
            $('#toggle-sidebar-btn').click(function() {
                $('#sidebar').toggleClass('d-none');
                $('#main-content').toggleClass('col-md-9 col-md-12');
            });
        });
    </script>
@endsection
