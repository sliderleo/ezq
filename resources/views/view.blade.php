<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Styles --}}
    <link href="/css/main.css" rel="stylesheet">
    <title>View Page</title>
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>V_ID</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Img</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($store as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->vendor_id}}</td>
                    <td>{{$item->contact}}</td>
                    <td>{{$item->address}}</td>
                    <td>
                        <img src="/image/store/{{$item->store_img}}" width="70px" alt="Image Here"/>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
        
    </table>
</body>
</html>