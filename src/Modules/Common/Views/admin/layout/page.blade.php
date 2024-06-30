<script>
    if (typeof fromajax === 'undefined') {
        localStorage.setItem('route', window.location);
        window.location = "{{ route('admin.load') }}";
    } else {
        localStorage.setItem('route', 0);
    }
    $("[role='navigation'] a").addClass('mlink');
</script>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __($title) }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a class="mlink" href="{{ url('admin') }}">{{ __('Home page') }}</a>
                    </li>
                    @if (isset($treeView))
                        @foreach ($treeView as $row)
                            <li class="breadcrumb-item"><a class="mlink"
                                    href="{{ $row['link'] }}">{{ __($row['title']) }}</a></li>
                        @endforeach
                    @endif
                    <li class="breadcrumb-item active"><a class="mlink" href="#!"
                            onclick="return false;">{{ __($title) }}</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @yield('page')
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
