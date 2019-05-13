<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Karangwidoro Dashboard</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                @if(auth()->check())
                    <p class="navbar-text">{{ strtoupper(auth()->user()->username) }}</p>
                @endif
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        @if(auth()->check())
                        <li><a href="/ubah_pass"><i class="fa fa-wrench fa-fw"></i> Ubah Password</a>
                        </li>
                        <li class="divider"></li>
                            <li><a href="/logout"><i class="fa fa-sign-out-alt fa-fw"></i> Logout</a>
                        @else
                            <li><a href="/login"><i class="fa fa-sign-in-alt fa-fw"></i> Login</a>
                        @endif
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            @include('layout.sidebar')
        </nav>