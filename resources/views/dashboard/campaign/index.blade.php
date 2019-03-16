@extends('dashboard.base')

@section('head')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<style type="text/css">
    .select2-container {
        width: 100% !important;
    }
</style>
@endsection

@section('content')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Campaigns</h2>
                        <div class="overview-wrap">
                            <a class="au-btn au-btn-icon au-btn--blue btn-secondary" href="{{ route('create-campaign') }}">
                            <i class="zmdi zmdi-plus"></i>create campaign</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c1">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    
                                </div>
                                <div class="text">
                                    <h2>{{ $totalCampaign }}</h2>
                                    <span>Total Campaigns</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c2">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    
                                </div>
                                <div class="text">
                                    <h2>{{ $activeCampaign }}</h2>
                                    <span>Active Campaigns</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="overview-item overview-item--c3">
                        <div class="overview__inner">
                            <div class="overview-box clearfix">
                                <div class="icon">
                                    
                                </div>
                                <div class="text">
                                    <h2>{{ $pausedCampaign }}</h2>
                                    <span>Paused Campaigns</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DATA TABLE -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">All Campaigns</h3>
                    <div class="table-responsive m-b-40">
                        <table class="table table-borderless table-data3">
                            <thead>
                                <tr>
                                    <th>name</th>
                                    <th>frequency</th>
                                    <th>target</th>
                                    <th>date</th>
                                    <th>status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!$campaigns->isEmpty())
                            @foreach($campaigns as $campaign)
                                <tr class="tr-shadow">
                                    <td>{{$campaign->name}}</td>
                                    <td>
                                        @if($campaign->is_recurring)
                                        <span class="block-email">every {{$campaign->interval_day}} days</span>
                                        @else
                                        <span class="block-email">Once</span>
                                        @endif
                                    </td>
                                    @if($campaign->target_type == 'status')
                                    <td class="desc">{{$campaign->status->name}}</td>
                                    @elseif($campaign->target_type == 'group')
                                    <td class="desc">{{$campaign->group['name']}}</td>
                                    @else
                                    <td class="desc">{{$campaign->contact['firstname']}} {{$campaign->contact['lastname']}}</td>
                                    @endif
                                    <td>{{ $campaign->next_send_date->format('d/m/Y h:i a') }}</td>
                                    <td>
                                        @if($campaign->is_active)
                                        <span class="status--process">Active</span>
                                        @else
                                        <span class="status--process">Paused</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if($campaign->is_active)
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Pause">
                                            @else
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Activate">
                                            @endif
                                                <i class="zmdi zmdi-mail-send"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="spacer"></tr>
                            @endforeach
                            @else
                                <tr class="tr-shadow">
                                </tr>
                                <tr class="spacer"></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>


@endsection

@section('javascript')


<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>


@endsection