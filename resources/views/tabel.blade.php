<!DOCTYPE html>
<html>
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Title of the document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="h1">
Content loading... <br>
<table id="my_table" class="table mt-5 table-dark">
</table>
</body>

<script type="text/javascript">
    console.log("started")
    let idk
    function initData(name, tbl, bdy) {
        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}"
            },
            async: true,
            url: name,
            type: "POST",
            success: function(data){
                idk = JSON.parse(data)
                console.log(idk)
                tbl.append('<tr>' + '<th>' + idk['brandname'] + '</th>' + '<th>' + idk['kpis']['total_fans']['current_period']['string'] + '</th>' + '<th>' + idk['kpis']['total_engagement']['current_period']['string'] + '</th></tr>')
            },
            error: function(data){
            },
            complete: function() {
                if(idk['brandname'] == 'Lamborghini') {
                    bdy.text('Content loaded successfully!')
                    bdy.css("color", "green")
                }
                else {
                    bdy.text('The page is loading table elements...')
                }
                bdy.append(tbl)
            }
        });
    }
    $(document).ready(function(e){
        let bdy = $("body")
        let tbl = $("#my_table")
        tbl.append('<tr>' + '<th>' + 'Brand' + '</th>' + '<th>' + 'Number of fans' + '</th>' + '<th>' + 'Total engagement' + '</th></tr>')
        $.ajax({
            data: {
                "_token": "{{ csrf_token() }}"
            },
            async: true,
            url: '',
            type: "POST",
            success: function(data){
                console.log(data)
                data.forEach(member =>initData(member['brandname'], tbl, bdy));
            },
            error: function(data){
            }
        });
    });
</script>
