<!DOCTYPE html>
<html lang="en">
@include('template.head')

<body class="fix-header">


    <div id="wrapper">

        @include('template.navbar')

        @include('template.sidebar')
        <div id="page-wrapper">
            <div class="container-fluid">
                    <div class="row bg-title">
                            
                            <!-- /.col-lg-12 -->
                        </div>
                    @if(count($errors) > 0)
                    @include('template.errors')
                @endif
                <br>
                @yield('content')

            </div>

            @include('template.footer')
        </div>

    </div>

    @include('template.script')
</body>

</html>
