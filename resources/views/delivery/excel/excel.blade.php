<table style="text-align: center;">
    <thead>
        <tr>
            <th>Mail</th>
            <th>Shop Name</th>
            <th>Shop Address</th>
            <th>Driver Assigned</th>
            <th>Part Number</th>
            <th>Payment Method</th>
            <th>Returned</th>
            <th>Parts Returned</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $delivery)
        <tr>
            <td>{{ $delivery['mail']  }}</td>
            <td>{{ $delivery['shop_name'] }}</td>
            <td>{{ $delivery['shop_address'] }}</td>
            <td>{{ $delivery['driver_assigned'] }}</td>
            <td>{{ $delivery['part_number'] }}</td>
            @if($delivery['payment_method'] == 1)
            <td>Cash</td>
            @elseif($delivery['payment_method'] == 2)
            <td>Check</td>
            @elseif($delivery['payment_method'] == 3)
            <td>Credit Card</td>
            @elseif($delivery['payment_method'] == 4)
            <td>Charge Account</td>
            @else
            <td>NULL</td>
            @endif

            @if($delivery['returned'] == 1)
            <td>Yes</td>
            @else
            <td>No</td>
            @endif
            <td>{{ $delivery['parts_returned'] }}</td>
            <td>${{ number_format($delivery['total'], 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>