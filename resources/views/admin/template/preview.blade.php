<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$template->title}} Template Preview</title>
</head>
<body>
    <div class="modal-body">
        {!!$template->html !!}
    </div>
</body>
</html>

