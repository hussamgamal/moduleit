<div class="row">
    <div class="col-sm-12">
        @if ($info = $model->provider)
            <table class="table table-bordered table-stripped">
                <tbody>
                    <th colspan="2" style="background-color: orange">
                        @lang('Provider info')
                    </th>
                    <tr>
                        <th>@lang("Area")</th>
                        <td>{{ $info->area->name->{app()->getLocale()} ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>@lang("Plan")</th>
                        <td>{{ $info->plan->name->{app()->getLocale()} ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>@lang('Delivery')</th>
                        <td>{{ $info->delivery ? __('Yes') : __('No') }}</td>
                    </tr>
                    <tr>
                        <th>@lang('About')</th>
                        <td>{{ $info->about }}</td>
                    </tr>
                    <tr>
                        <th>@lang('Address')</th>
                        <td>{{ $info->location['address'] ?? '' }}</td>
                    </tr>

                    <tr>
                        <th>@lang('Working days')</th>
                        <td>
                            @if($info->working_days)
                            @foreach ($info->working_days as $row)
                                <li>@lang($row)</li>
                            @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>@lang('Working time')</th>
                        <td>@lang('From') : {{ hours($info->working_from) }} - @lang('To') : {{ hours($info->working_to) }}</td>
                    </tr>
                    @if($account = $info->bank_account)
                        <tr>
                            <th colspan="2">@lang('Bank Account')</th>
                        </tr>
                        <tr>
                            <th>@lang('Account ID')</th>
                            <td>{{ $account['id'] }}</td>
                        </tr>
                        <tr>
                            <th>@lang('Account Name')</th>
                            <td>{{ $account['name'] }}</td>
                        </tr>
                        <tr>
                            <th>@lang('IPAN')</th>
                            <td>{{ $account['ipan'] }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @endif
    </div>
</div>
