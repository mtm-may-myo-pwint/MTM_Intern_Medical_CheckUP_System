@extends('layouts.app')
@section('content')
<div class="container">
    <h4 class="text-center mb-3">Check-up History</h4>
    <div class="card">
        <div class="card-header bg-white">
            <div class="row mb-3 mt-3">
                <div class="form-group col-md-2">
                    <div class="form-label">{{__('Name')}}</div>
                    <input type="search" class="form-control" name="search" id="search" value="{{ request('search') }}">
                </div>
                <div class="form-group col-md-2">
                    <div class="form-label">{{__('YYYYMM (FROM)')}}</div>
                    <input type="month" class="form-control" name="from_date" id="from_date" value="{{ request('from_date',now()->subYear()->startOfYear()->format('Y-m')) }}" onkeydown="return false;" onpaste="return false;">
                </div>
                <div class="form-group col-md-2">
                    <div class="form-label">{{__('YYYYMM (TO)')}}</div>
                    <input type="month" class="form-control" name="to_date" id="to_date" value="{{ request('to_date',now()->format('Y-m')) }}" onkeydown="return false;" onpaste="return false;">
                </div>
                <div class="form-group col-md-2">
                    <div class="form-label">{{__('Package')}}</div>
                    <select class="form-control" id="package_id" name="package_id">
                        <option value="">Choose Package</option>
                        @foreach($packages as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2 d-flex align-items-end">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="resign_member" name="resign_member" value="">
                        <label class="form-check-label" for="resign_member">Show Resign Member</label>
                    </div>
                </div>
                <div class="form-group col-md-2 d-flex align-items-end">
                    <div>
                        <button class="btn btn-outline-primary me-2 search"><i class="fas fa-magnifying-glass"></i> {{__('Search')}}</button>
                        <button class="btn btn-outline-primary clear"><i class="fas fa-refresh"></i> {{__('Clear')}}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mt-3">
                <a href="#" class="btn btn-outline-primary ml-auto"> {{ __('Check-up Current Month List') }}</a>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead class="table-secondary">
                            <tr>
                                <th class="text-center" >{{ __('No') }}</th>
                                <th class="text-center" >{{ __('Name') }}</th>
                                <th class="text-center" >{{ __('Hepatitis B 4th Dose @ MTM ') }}</th>
                                <th class="text-center" >{{ __('Check-up') }}</th>
                                <th class="text-center" >{{ __('Package') }}</th>
                                <th class="text-center" >{{ __('Option Test') }}</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach($checkup_history as $histories) 
                                @foreach($histories as $index => $history)
                                    <tr>
                                        @if($index == 0)
                                            <td rowspan="{{count($histories)}}" class="text-center" >{{$loop->parent->iteration}}</td>
                                            <td rowspan="{{count($histories)}}" class="text-center" >{{$history->employee?->name ?? ''}}</td>
                                        @endif
                                        <td class="text-center">{{$history->last_vaccinated_date ?? ''}}</td>
                                        <td class="text-center">{{$history->checkup_date ?? ''}}</td>
                                        <td class="text-center">{{$history->package?->package_name ?? ''}}</td>
                                        <td class="text-center">{{$history->optional_test ?? ''}}</td>
                                    </tr>
                                @endforeach
                             @endforeach  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
      $(document).ready(function () {
          
        $('.search').on('click',function(event){
              event.preventDefault();

              let search = $('#search').val();
              let from_date = $('#from_date').val();
              let to_date = $('#to_date').val();
              let package_id = $('#package_id').val();
              let resign_member = $('#resign_member').is(':checked') ? 1 : 0;

                console.log('resign',resign_member);
                console.log('search',search);
                

              $.ajax({

                url: 'checkup-history/search',
                type: 'GET',
                data: {
                    from_date: from_date,
                    to_date: to_date,
                    package_id: package_id,
                    resign_member: resign_member,
                    search: search
                },
               success: function(response) {
                    console.log('response',response);
                    console.log('data length', Object.values(response.data));
                    
                    let html = "";

                    Object.values(response.data).forEach((histories, groupIndex) => {
                        histories.forEach((history, index) => {
                            html += `<tr>`;
                            if (index === 0) {
                                html += `<td rowspan="${histories.length}" class="text-center">${groupIndex + 1}</td>`;
                                html += `<td rowspan="${histories.length}" class="text-center">${history.employee?.name ?? ''}${history.employee?.resign_date ? '(resign)' : ''}</td>`;

                            }
                            html += `<td class="text-center">${history.last_vaccinated_date ?? ''}</td>`;
                            html += `<td class="text-center">${history.checkup_date ?? ''}</td>`;
                            html += `<td class="text-center">${history.package?.package_name ?? ''}</td>`;
                            html += `<td class="text-center">${history.optional_test ?? ''}</td>`;
                            html += `</tr>`;
                        });
                    });

                    $('#tbody').html(html);
                }

              })

        });

        $('.clear').on('click',function(event){
            event.preventDefault();

            window.location.reload();

        })
        
      });
</script>
@endsection
