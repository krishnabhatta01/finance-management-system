<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Account_Holder </th>
            <th>Account_no. </th>
            <th>Balance </th>
            <th>Loan_dispursion </th>
            
            <th>Account_opened </th>
            <!-- Add more table columns as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($tableData as $data)
            <tr>
                <td>{{ $data->Id }}</td>
                <td>{{ $data->Account_Holder}}</td>
                <td>{{ $data->Account_np.}}</td>
                <td>{{ $data->Balance}}</td>
                <td>{{ $data->Loan_dispursion}}</td>
                <td>{{ $data->Account_opened}}</td>
                <!-- Display more table data as needed -->
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>