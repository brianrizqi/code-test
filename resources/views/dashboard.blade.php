<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/components.css') }}">
    <style>
        .modal {
            position: absolute;
            left: 25%;
            top: 5%;
            width: 50%;
            height: 100%;
        }
    </style>
</head>

<body>
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                    </li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                class="fas fa-search"></i></a></li>
                </ul>
            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown"
                                        class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" src="{{ asset('assets/dashboard/img/avatar/avatar-1.png') }}"
                             class="rounded-circle mr-1">
                        <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                    <a href="index.html">Stisla</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="index.html">St</a>
                </div>
                <ul class="sidebar-menu">
                    <li class="menu-header">Dashboard</li>
                    <li><a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                    </li>
                </ul>
            </aside>
        </div>


        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Table</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    </div>
                </div>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="section-body">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Simple Table</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md">
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Position</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($users as $key => $user)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->position->position }}</td>
                                                    <td>
                                                        <div
                                                            class="badge badge-{{ $user->position->status == 'active' ? 'success' : 'danger' }}">
                                                            {{ ucfirst($user->position->status) }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->created_at->format('d M Y h:i A') }}</td>
                                                    <td>
                                                        @if(Auth::user()->id == $user->id)
                                                            <a href="#" class="btn btn-primary"
                                                               id="btn-open-modal">Detail</a>
                                                        @else
                                                            <a href="#" class="btn btn-secondary">Detail</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="modal" id="modal-edit">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.edit-profile') }}" method="POST"
                          id="edit-form">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ Auth::user()->email }}" name="email">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option
                                    value="active" {{ Auth::user()->position->status == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>
                                <option
                                    value="inactive" {{ Auth::user()->position->status == 'inactive' ? 'selected' : '' }}>
                                    Inctive
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="position">
                                <option value="User" {{ Auth::user()->position->position == 'User' ? 'selected' : '' }}>
                                    User
                                </option>
                                <option
                                    value="Super User" {{ Auth::user()->position->position == 'Super User' ? 'selected' : '' }}>
                                    Super User
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary"
                            onclick="event.preventDefault(); document.getElementById('edit-form').submit();">Save
                        changes
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <div class="footer-left">
                Copyright &copy; 2018
                <div class="bullet"></div>
                Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
            </div>
            <div class="footer-right">
                2.3.0
            </div>
        </footer>
    </div>
</div>
<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('assets/dashboard/js/stisla.js') }}"></script>

<!-- JS Libraies -->
{{--<script src="../node_modules/jquery-ui-dist/jquery-ui.min.js"></script>--}}

<!-- Template JS File -->
<script src="{{ asset('assets/dashboard/js/scripts.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/custom.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/components-table.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/page/bootstrap-modal.js') }}"></script>
<script>
    $('#btn-open-modal').click(function (e) {
        e.preventDefault();
        $('#modal-edit').modal('show')
    })
</script>
</body>
</html>
