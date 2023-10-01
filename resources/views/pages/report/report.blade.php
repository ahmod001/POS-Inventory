<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            width: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }
    </style>
</head>

<body>

    <H1>Summary</H1>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Report</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Total</th>
                <th>VAT</th>
                <th>Payable</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sales report</td>
                <td>{{ $fromDate }}</td>
                <td>{{ $toDate }}</td>
                <td>{{ $total }}</td>
                <td>{{ $vat }}</td>
                <td>{{ $payable }}</td>
            </tr>
        </tbody>
    </table>

    <H1>Details</H1>
    <table class="styled-table">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Total</th>
                <th>Discount</th>
                <th>VAT</th>
                <th>Payable</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $invoice)
                <tr>
                    <td>{{ $invoice['customer']['name'] }}</td>
                    <td>{{ $invoice['customer']['mobile'] }}</td>
                    <td>{{ $invoice['customer']['email'] }}</td>
                    <td>{{ $invoice['total'] }}</td>
                    <td>{{ $invoice['discount'] }}</td>
                    <td>{{ $invoice['vat'] }}</td>
                    <td>{{ $invoice['payable'] }}</td>
                    <td>{{ $invoice['created_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
