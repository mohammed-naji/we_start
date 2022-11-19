<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Many to Many</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h2>Welcome: {{ $std->name }}</h2>
        {{-- @dump($std->courses) --}}
        <form action="{{ route('many_to_many') }}" method="POST">
        @csrf
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Hours</th>
                <th>Mark</th>
            </tr>
            @foreach ($courses as $course)
                <tr>
                    <td> <input data-id="{{ $course->id }}" @checked( $std->courses->find( $course->id ) ) type="checkbox" name="courses[]" value="{{ $course->id }}"> {{ $course->id }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->hours }}</td>
                    <td>
                        <input {{ $std->courses->find( $course->id ) && $std->courses->find( $course->id )->show->mark ? '' : 'disabled' }} id="mark-{{ $course->id }}" type="text" name="marks[{{ $course->id }}][mark]" placeholder="Mark" class="form-control" value="{{ $std->courses->find( $course->id )->show->mark??'' }}">
                    </td>
                </tr>
            @endforeach
        </table>
        <button class="btn btn-success">Register</button>
        </form>
    </div>



    <script>

        let incheck = document.querySelectorAll('input[type=checkbox]')

        incheck.forEach(el => {
            el.onchange = () => {

                // let id = el.getAttribute('data-id');
                let id = el.dataset.id;
                // console.log(el.checked);
                if(el.checked) {
                    document.querySelector('#mark-'+id).disabled = false;
                }else {
                    document.querySelector('#mark-'+id).disabled = true;
                }
            }
        });
    </script>
</body>
</html>
