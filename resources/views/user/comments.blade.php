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
                            {{-- @foreach ($comments_blog as $comment)
                                <div class="comment">
                                    <p>{{ $comment->body }}</p>
                                    @if ($comment->replies)
                                        <div class="replies">
                                            @foreach ($comment->replies as $reply)
                                                <div class="comment">
                                                    <p>{{ $reply->body }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <form method="POST" action="{{ route('comments.store') }}">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $id }}">
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                        <textarea name="body"></textarea>
                                        <button type="submit">Reply</button>
                                    </form>
                                </div>
                            @endforeach --}}
                            @foreach ($comments_blog as $comment)
                                <div class="">
                                    @if ($comment->parent_id == null)
                                        <p class="parent_comment">{{ $comment->body }} - {{ $comment->user->name }}</p>
                                        <form method="POST" action="{{ route('comments.replystore') }}">
                                            @csrf
                                            <div class="row">

                                                <div class="col-md-8">
                                                    <textarea name="body" placeholder="Type your Reply"></textarea>
                                                    <input type="hidden" name="blog_id" value="{{ $id }}">
                                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                </div>
                                                <div class="col-md-4"><button class="btn btn-primary comment-btn"
                                                        type="submit">Reply</button></div>
                                            </div>


                                        </form>
                                    @endif



                                    @foreach ($comment->replies as $child)
                                        @if ($child->parent_id == $comment->id)
                                            <div class="child_comment">
                                                <p>{{ $child->body }} - {{ $child->user->name }}</p>
                                                {{-- <form method="POST" action="{{ route('comments.replystore') }}">
                                                    @csrf
                                                    <div class="row">

                                                        <div class="col-md-8">
                                                            <textarea name="body" placeholder="Type your Reply"></textarea>
                                                            <input type="hidden" name="blog_id"
                                                                value="{{ $id }}">
                                                            <input type="hidden" name="comment_id"
                                                                value="{{ $child->id }}">
                                                        </div>
                                                        <div class="col-md-4"><button
                                                                class="btn btn-primary comment-btn"
                                                                type="submit">Reply</button></div>
                                                    </div>


                                                </form> --}}
                                            </div>
                                        @endif
                                    @endforeach


                                </div>
                            @endforeach
                        @endif




                        <form method="POST" action="{{ route('comments.store') }}">
                            @csrf
                            <div class="row">

                                <div class="col-md-8">
                                    <label>Add your Comment</label><br>
                                    <textarea placeholder="Type your Comment" name="body"></textarea><br>
                                    <input type="hidden" name="blog_id" value="{{ $id }}">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary comment-btn" type="submit">Submit</button>
                                </div>
                            </div>


                        </form>
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
