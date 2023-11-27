<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users curd</title>
</head>
<body>
    <table class= "table-table-boadered">
        <tr>
            <th>name</th>
            <th>email</th>
            <th>phone</th>
            <th width = "280px">action</th>
        </tr>
            @foreach($users as $users)
            <tr>
                <td>{{$users->name}}</td>
                <td>{{$users->email}}</td>
                <td>{{$users->phone}}</td>
                <td>{{$i++}}</td>
               

                
                <td>{{}$i++}</td>
                <td>
                           
                            <a href="{{ route('users.show', $users->id) }}">View</a>
                            <a href="{{ route('users.edit', $users->id) }}">Edit</a>
                          
                            <!-- <form action="{{ route('$users.destroy', $users->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form> -->
                        </td>
            </tr>
    </table>
</body>
</html>