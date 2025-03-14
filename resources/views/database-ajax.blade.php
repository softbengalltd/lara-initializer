<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ getenv('app_name') ?? 'App Database Setup' }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            padding: 30px;
        }

        .mysql-fields {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">

        @if (session('error'))
            <div class="toasts-top-right fixed">
                <div class="toast bg-danger fade show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header"><strong class="mr-auto">{{ session('error') }}</strong><button
                            data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span
                                aria-hidden="true">×</span></button></div>
                </div>
            </div>
        @endif
        @if (session('success'))
            <div class="toasts-top-right fixed">
                <div class="toast bg-success fade show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header"><strong class="mr-auto">{{ session('success') }}</strong><button
                            data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span
                                aria-hidden="true">×</span></button></div>
                </div>
            </div>
        @endif

        <div class="card p-0">
            <div class="card-header d-flex align-items-center justify-content-center">
                <img src="https://squartup.com/images/logo-sm.png" style="height: 100px" alt="">
                <p style="margin-top: 20px; font-weight: bold;">
                    <span style="font-size: 20px;color: #e33fa2">Squartup</span>
                    <span style="font-size: 30px; color: #7b48cd;">|</span>
                    <span style="font-size: 20px;color: #7b48cd;">Laravel Setup</span>
                </p>
            </div>

            <form id="dbform" method="POST" action="{{ route('squartup.setup.submit') }}">
                @csrf
                <input type="hidden" name="step" value="database">
                <div class="card-body">

                    <!-- Database Type Selection -->
                    <div class="form-group">
                        <label>Select Database Type</label>
                        <div>
                            <label>
                                <input type="radio" name="db_connection" value="sqlite"
                                    onchange="toggleDatabaseFields()" @if (getenv('DB_CONNECTION') == 'sqlite') checked @endif>
                                SQLite
                            </label>
                            <label>
                                <input type="radio" name="db_connection" value="mysql"
                                    onchange="toggleDatabaseFields()" @if (getenv('DB_CONNECTION') == 'mysql') checked @endif>
                                MySQL
                            </label>
                        </div>
                    </div>

                    <!-- MySQL Settings (Hidden by default, shown when MySQL is selected) -->
                    <div class="mysql-fields">
                        <div class="form-group">
                            <label>DB Host @if ($errors->has('db_host'))
                                    <span class="text-danger">required*</span>
                                @endif
                            </label>
                            <input type="text" class="form-control" name="db_host"
                                value="{{ old('db_host') ?? (getenv('DB_HOST') ?? '127.0.0.1') }}"
                                placeholder="Enter database host (e.g., 127.0.0.1)">
                        </div>
                        <div class="form-group">
                            <label>DB Port @if ($errors->has('db_port'))
                                    <span class="text-danger">required*</span>
                                @endif
                            </label>
                            <input type="number" class="form-control" name="db_port"
                                value="{{ old('db_port') ?? (getenv('DB_PORT') ?? '3306') }}"
                                placeholder="Enter database port (e.g., 3306)">
                        </div>
                        <div class="form-group">
                            <label>DB Database @if ($errors->has('db_database'))
                                    <span class="text-danger">required*</span>
                                @endif
                            </label>
                            <input type="text" class="form-control" name="db_database"
                                value="{{ old('db_database') ?? (getenv('DB_DATABASE') ?? 'fresh') }}"
                                placeholder="Enter database name (e.g., fresh)">
                        </div>
                        <div class="form-group">
                            <label>DB Username @if ($errors->has('db_username'))
                                    <span class="text-danger">required*</span>
                                @endif
                            </label>
                            <input type="text" class="form-control" name="db_username"
                                value="{{ old('db_username') ?? (getenv('DB_USERNAME') ?? 'root') }}"
                                placeholder="Enter database username (e.g., root)">
                        </div>
                        <div class="form-group">
                            <label>DB Password @if ($errors->has('db_password'))
                                    <span class="text-danger">required*</span>
                                @endif
                            </label>
                            <input type="password" class="form-control" name="db_password"
                                value="{{ old('db_password') ?? (getenv('DB_PASSWORD') ?? '') }}"
                                placeholder="Enter database password">
                        </div>
                    </div>

                    <a href="{{ route('squartup.setup.form', ['email']) }}" class="btn"
                        style="background-color: #7b48cd; color: white; width: 200px; float: left;">Email Setup</a>

                    <button type="button" id="submit-btn" class="btn"
                        style="background-color: #7b48cd; color: white; width: 200px; float: right;">Next</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        alert("Please wait sometime, to relode server.");

        function toggleDatabaseFields() {
            const dbConnection = document.querySelector('input[name="db_connection"]:checked').value;
            const mysqlFields = document.querySelector('.mysql-fields');

            if (dbConnection === 'mysql') {
                mysqlFields.style.display = 'block';
            } else {
                mysqlFields.style.display = 'none';
            }
        }
        document.addEventListener("DOMContentLoaded", toggleDatabaseFields);
    </script>
    <script>
        $(document).ready(function() {
            $('.toast').toast({
                delay: 5000
            });
            $('[data-dismiss="toast"]').click(function() {
                $(this).closest('.toast').toast('hide');
            });
        });
    </script>


    <script>
        $.ajaxSetup({
            headers: {
                'x-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var form = $('#dbform');
            $('#submit-btn').on('click', (e) => {
                e.preventDefault();
                $.ajax({
                    url: form.attr('action'),
                    type: 'post',
                    data: form.serialize(),
                    success: function(data) {
                        if(data.status =="success"){
                           alert(' successf');
                        } else{
                            alert("Wait, faild");
                        }
                            setTimeout(() => {
                                
                            location.reload(true);
                            }, 4000);
                    }
                });
            });
        });
    </script>
</body>

</html>
