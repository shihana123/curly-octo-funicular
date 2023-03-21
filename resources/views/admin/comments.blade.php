<!DOCTYPE html>
<html>

<head>
    <title>User Panel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">User Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('adminblog') }}">View Blogs</a>
                </li>

                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="nav-link" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid mt-3">
        <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        @if (!empty($comments_blog))

                            @foreach ($comments_blog as $comment)
                                <div class="">
                                    @if ($comment->parent_id == null)
                                        <p class="parent_comment">{{ $comment->body }} - {{ $comment->user->name }}</p>
                                    @endif



                                    @foreach ($comment->replies as $child)
                                        {{-- @if ($child->parent_id == $comment->id) --}}
                                        <div class="child_comment">
                                            <p>{{ $child->body }} - {{ $child->user->name }}</p>

                                        </div>
                                        {{-- @endif --}}
                                    @endforeach


                                </div>
                            @endforeach
                        @else
                            <h5>No Comments yet</h5>
                        @endif

                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
