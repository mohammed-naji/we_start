<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>One to Many</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->body }}</p>
        <hr>
        <h4>All Comments ({{ $post->comments_count }})</h4>
        <ul id="comment_wrapper" class="list-unstyled">
            @foreach ($post->comments as $comment)
                <li>
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="m-0">{{ $comment->user->name }}</h5>
                        <span class="mx-3">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p>{{ $comment->content }}</p>
                </li>
            @endforeach
        </ul>
        <hr>
        <form id="post_comment" action="{{ route('add_comment') }}" method="POST">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="hidden" name="user_id" value="{{ 5 }}">
            <textarea name="content" class="form-control" rows="5" placeholder="Type you comment.."></textarea>
            <button class="btn btn-dark mt-2 px-5">Post</button>
        </form>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        let form = document.querySelector('#post_comment');
        let comments = document.querySelector('#comment_wrapper');

        form.onsubmit = (e) => {
            e.preventDefault();

            let data = new FormData(form);

            let url = form.action;
            // console.log(url);
            axios.post(url, data)
            .then(res => {
                form.reset();
                let item = `<li>
                    <div class="d-flex align-items-center mb-3">
                        <h5 class="m-0">${ res.data.user.name }</h5>
                        <span class="mx-3">${ res.data.created_at }</span>
                    </div>
                    <p>${ res.data.content }</p>
                </li>`

                comments.innerHTML += item
            })
        }
    </script>

</body>
</html>
