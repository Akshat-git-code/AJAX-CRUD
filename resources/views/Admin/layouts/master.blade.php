<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.head')
<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
            @include('admin.layouts.navbar')
            @include('admin.layouts.sidebar')
            <div class="main-content">
                <section class="section">
                    @yield('main-content')
                </section>
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>
    @include('admin.layouts.scripts')
</body>
</html>
