<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">

    <title>Invoice</title>

    <style>
        body {
            font-family: "Open Sans", sans-serif;
        }

        .total {
            background: #ffffff;
            botder-bottom: 1px solid #cccccc;
        }

        table tr.total td {
            padding: 0.5rem;
        }

        .w-full {
            width: 100%;
        }

        .w-half {
            width: 50%;
            font-size: 22px;
        }

        .margin-top {
            margin-top: 1.25rem;
        }

        table {
            width: 100%;
            border-spacing: 0;
        }

        table.products {
            font-size: 18px;
        }

        table.products tr {
            background-color: #ffffff;
        }

        table.products th {
            font-size: 14px;
            text-align: left;
            color: #82858c;
            padding: 0.5rem;
        }

        table tr.items {
            background-color: rgb(241 245 249);
        }

        table tr.items td {
            padding: 0.5rem;
        }
    </style>
</head>

<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <h1>{{ $invoice->company_name }}</h1>
                <b>
                    VAT number : {{ $invoice->company_vat_number }}
                </b>
            </td>
            <td class="w-half">
                <h2>Invoice # {{ $invoice->id }}</h2>
            </td>
        </tr>
    </table>

    <div class="margin-top">
        <table class="w-full">
            <tr>
                <td class="w-half">
                    <div>
                        <h4>To:</h4>
                    </div>
                    <div>{{ $invoice->client_name }}</div>
                    <div>
                        {{ $invoice->client_address_line_1 ? $invoice->client_address_line_1 . ', ' : '' }}
                        {{ $invoice->client_address_line_2 ? $invoice->client_address_line_2 . ', ' : '' }}
                        {{ $invoice->client_city ? $invoice->client_city . ', ' : '' }}
                        {{ $invoice->client_county ? $invoice->client_county . ', ' : '' }}
                        {{ $invoice->client_postcode ? $invoice->client_postcode . '. ' : '' }}
                    </div>
                </td>
                <td class="w-half">
                    <div>
                        <h4>From:</h4>
                    </div>
                    <div>{{ $invoice->company_name }}</div>
                    <div>
                        {{ $invoice->company_address_line_1 ? $invoice->company_address_line_1 . ', ' : '' }}
                        {{ $invoice->company_address_line_2 ? $invoice->company_address_line_2 . ', ' : '' }}
                        {{ $invoice->company_city ? $invoice->company_city . ', ' : '' }}
                        {{ $invoice->company_county ? $invoice->company_county . ', ' : '' }}
                        {{ $invoice->company_postcode ? $invoice->company_postcode . '. ' : '' }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="margin-top">
        <table class="products">
            <tr>
                <th style="width: 700px;">Name</th>
                <th>Amount</th>
                <th>Unit</th>
                <th>Total charge</th>
            </tr>
            @foreach ($invoice->products as $product)
                <tr class="items">
                    <td>
                        {{ Str::limit($product['name'], 75, $end = '...') }}
                    </td>
                    <td>
                        {{ $product['amount'] }}
                    </td>
                    <td>
                        {{ $product['unit'] }}
                    </td>
                    <td>
                        {{ $product['total_charge'] }}
                    </td>
                </tr>
            @endforeach
            <tr class="total">
                <td><b>Total</b></td>
                <td></td>
                <td></td>
                <td>
                    <b>{{ $invoice->total }}</b>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
