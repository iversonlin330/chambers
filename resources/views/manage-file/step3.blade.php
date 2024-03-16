@extends('layouts.app')

@section('title', '定恆')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">步驟三：記錄費用</span></h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            {{--            <h5 class="card-header">Table Basic</h5>--}}
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table id="cost_table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>路徑</th>
                            <th>案件</th>
                            <th>項目</th>
                            <th>金額</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @for($i = 1;$i<=0;$i++)
                            <tr>
                                <td>案件A</td>
                                <td>
                                    <select class="selectpicker" id="exampleFormControlSelect1"
                                            aria-lbel="Default select example">
                                        <option value="">空白請選此項</option>
                                        <option value="1">案件A</option>
                                        <option value="2">案件B</option>
                                        <option value="3">案件C</option>
                                        <option value="4">案件D</option>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" placeholder=""></td>
                                <td><input type="number" class="form-control" placeholder=""></td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-end mt-3">
                    <div class="col-sm-7">
                        {{--                        <button type="submit" class="btn btn-primary">下一步</button>--}}
                        <a class="btn btn-primary" href="{{ url('events/create') }}">略過</a>
                        <a class="btn btn-primary" href="{{ url('events/create') }}">送出</a>
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
            let files = localStorage.getItem('postFiles');
            files = JSON.parse(files);
            console.log(files);
            files.forEach(function(file) {
                // 创建新的表格行
                let newRow = $('<tr>');

                // 添加第一个单元格（案件名称）
                newRow.append('<td>' + file.checkboxValue + '</td>');

                // 添加第二个单元格（选择案件下拉列表）
                let selectOptions = '<option value="">空白請選此項</option>';
                for (let i = 0; i < 5; i++) {
                    selectOptions += '<option value="' + (i + 1) + '">' + '案件' + String.fromCharCode(65 + i) + '</option>';
                }
                newRow.append('<td><select class="form-control">' + selectOptions + '</select></td>');

                // 添加第三个和第四个单元格（文本框）
                newRow.append('<td><input type="text" class="form-control" placeholder=""></td>');
                newRow.append('<td><input type="number" class="form-control" placeholder=""></td>');

                // 将新行添加到表格的 <tbody> 中
                $('#cost_table tbody').append(newRow);
            });
        });
    </script>
@endsection
