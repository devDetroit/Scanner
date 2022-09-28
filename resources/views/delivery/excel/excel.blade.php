<table style="text-align: center;">
    <thead>
        <tr>
            <th style="border: 5px solid black">Name</th>
            <th style="border: 5px solid black">Shop Name</th>
            <th style="border: 5px solid black">Shop Address</th>
            <th style="border: 5px solid black">Driver Assigned</th>
            <th style="border: 5px solid black">Part Number</th>
            <th style="border: 5px solid black">Payment Method</th>
            <th style="border: 5px solid black">Returned</th>
            <th style="border: 5px solid black">Parts Returned</th>
            <th style="border: 5px solid black">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $delivery)
        <tr>
            <td style="border: 5px solid black">{{ $delivery['user']['name']  }}</td>
            <td style="border: 5px solid black">{{ $delivery['shop_name'] }}</td>
            <td style="border: 5px solid black">{{ $delivery['shop_address'] }}</td>
            <td style="border: 5px solid black">{{ $delivery['driver_assigned'] }}</td>
            <td style="border: 5px solid black">{{ $delivery['part_number'] }}</td>
            @if($delivery['payment_method'] == 1)
            <td style="border: 5px solid black">Cash</td>
            @elseif($delivery['payment_method'] == 2)
            <td style="border: 5px solid black">Check</td>
            @elseif($delivery['payment_method'] == 3)
            <td style="border: 5px solid black">Credit Card</td>
            @elseif($delivery['payment_method'] == 4)
            <td style="border: 5px solid black">Charge Account</td>
            @else
            <td style="border: 5px solid black">NULL</td>
            @endif

            @if($delivery['returned'] == 1)
            <td style="border: 5px solid black">Yes</td>
            @else
            <td style="border: 5px solid black">No</td>
            @endif
            <td style="border: 5px solid black">{{ $delivery['parts_returned'] }}</td>
            <td style="border: 5px solid black">${{ number_format($delivery['total'], 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>


<table style="text-align: center;">
    <thead>
        <tr>
            <th style="border: 5px solid black">METHOD</th>
            <th style="border: 5px solid black">TOTAL</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td style="border: 5px solid black">CASH</td>
            <td style="border: 5px solid black">${{ number_format($totales['payform']['CASH'], 2) }}</td>
        </tr>
        <tr>
            <td style="border: 5px solid black">CHECK</td>
            <td style="border: 5px solid black">${{ number_format($totales['payform']['CHECK'], 2) }}</td>
        </tr>
        <tr>
            <td style="border: 5px solid black">CREDIT CARD</td>
            <td style="border: 5px solid black">${{ number_format($totales['payform']['CREDIT CARD'], 2) }}</td>
        </tr>
        <tr>
            <td style="border: 5px solid black">CHARGE ACCOUNT</td>
            <td style="border: 5px solid black">${{ number_format($totales['payform']['CHARGE ACCOUNT'], 2) }}</td>
        </tr>
        <tr>
            <td style="border: 5px solid black">TOTAL</td>
            <td style="border: 5px solid black; background-color:green">${{ number_format($totales['payform']['CHARGE ACCOUNT'] + $totales['payform']['CREDIT CARD'] + $totales['payform']['CHECK'] + $totales['payform']['CASH'], 2) }}</td>
        </tr>

    </tbody>
</table>