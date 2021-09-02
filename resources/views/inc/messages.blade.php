<div class="pl-4 pr-4 m-auto">
    <!-- form validation errors -->
    @if ($errors->any())
    <div id="error" class="alert alert-danger">

        @foreach ($errors->all() as $error)
        <i class="fa fa-exclamation-triangle"></i>&emsp;{{ $error }} <br />
        @endforeach

    </div>
    <script>
        setTimeout(() => {
            document.getElementById("error").style.display = "none";
        }, 3000);
    </script>
    @endif

    <!-- custom messages -->
    @if (session('success'))
    <div id="success" class="alert alert-success">
    <i class="fa fa-check-circle"></i>&emsp;{{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("success").style.display = "none";
        }, 3000);
    </script>
    @endif

    @if (session('customError'))
    <div id="customError" class="alert alert-danger">
        <i class="fa fa-exclamation-triangle"></i>&emsp;{{ session('customError') }}
    </div>
    <script>
        setTimeout(() => {
            document.getElementById("customError").style.display = "none";
        }, 10000);
    </script>
    @endif
</div>
