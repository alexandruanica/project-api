<!DOCTYPE html>
<html>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Title of the document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
Content loading... <br>
</body>

<script type="text/javascript">
    console.log("started")
    function initData(name) {
        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}"
            },
            async: true,
            url: name,
            type: "POST",
            success: function(data){
                let idk = JSON.parse(data)
                console.log(idk)
            },
            error: function(data){
            },
        });
    }
    $(document).ready(function(e){
        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}"
            },
            async: true,
            url: '',
            type: "POST",
            success: function(data){
                arr = data;
                data.forEach(member => initData(member['brandname']));
                console.log("done");
                console.log(data)
            },
            error: function(data){
            },
        });
    });
</script>
