@foreach($checkup_history as $histories) 
    @foreach($histories as $index => $history)
        <tr>
            @if($index == 0)
                <td rowspan="{{count($histories)}}" class="text-center" >{{$loop->parent->iteration}}</td>
                <td rowspan="{{count($histories)}}" class="text-center" >{{$history['employee']['name'] ?? ''}}{{$history['employee']['resign_date'] ? '(resign)' : ''}}</td>
            @endif
            <td class="text-center">{{$history['last_vaccinated_date'] ?? ''}}</td>
            <td class="text-center">{{$history['checkup_date'] ?? ''}}</td>
            <td class="text-center">{{$history['package']['package_name'] ?? ''}}</td>
            <td class="text-center">{{$history['optional_test'] ?? ''}}</td>
        </tr>
    @endforeach
@endforeach  