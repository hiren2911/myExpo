

Hello Admin,<br/>

Your Planned event is completed. Please find event summary as below.<br/>

Event: {{$event->title}} <br/>

<table>
    <tr>
        <th>Stand No</th>
        <th>Price</th>
        <th>Booked</th>
        <th>Booked By</th>
    </tr>
    @foreach ($event->stands as $stand)
    <tr>
        <td>{{ $stand->standNo}}</td>
        <td>{{ $stand->price ? $stand->price : 'Free' }}</td>
        <td>{{ $stand->status ? 'Yes' : 'No'}}</td>
        <td>{{ $stand->status ? $stand->user->name : '-' }}</td>
    </tr>
    @endforeach
</table>

