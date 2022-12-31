<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="container my-5">
        <h1>All Notifications ({{ $user->unreadNotifications->count() }})</h1>
        <div class="list-group">
            @foreach ($user->notifications as $notify)
            <a href="notify/{{ $notify->id }}" class="list-group-item list-group-item-action {{ $notify->unread() ? 'active' : '' }}" aria-current="true">
                {{-- @dump($notify->data['msg']) --}}
                {{ $notify->data['msg']??'' }}
              </a>
            @endforeach
          </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
