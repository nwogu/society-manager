@extends('dashboard.base')

@section('content')
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Meetings</h2>
                                        <div class="overview-wrap">
                                            <a class="au-btn au-btn-icon au-btn--blue btn-secondary" href="{{ route('show-create-meeting') }}">
                                            <i class="zmdi zmdi-plus"></i>create meeting</a>
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
                                                <h2>{{ $generalData['members'] }}</h2>
                                                <span>Total Members</span>
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
                                                <h2>{{ $generalData['tasks'] }}</h2>
                                                <span>Pending Tasks</span>
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
                                                <h2>{{ $generalData['matters'] }}</h2>
                                                <span>Matters Arising</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Meetings</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>Presider</th>
                                                <th>Attendance</th>
                                                <th>Duration</th>
                                                <th>Total Reports</th>
                                                <th>Matters Arising</th>
                                                <th>Tasks</th>
                                                <th class="text-right"></th>
                                                <!-- <th class="text-right"></th>
                                                <th class="text-right"></th> -->
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if (empty($meetingData))
                                            <tr>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td class="text-right">---</td>
                                                
                                            </tr>
                                        @else
                                        @foreach ($meetingData as $meetingDetails)
                                            <tr>
                                                <td>{{ date('l, d M Y', strtotime($meetingDetails['meeting']->meeting_date)) }}</td>
                                                <td>{{ ucwords($meetingDetails['meeting']->type) }}</td>
                                                <td>{{ $meetingDetails['meeting']->presider()->first()->firstname }} {{ $meetingDetails['meeting']->presider()->first()->lastname }} </td>
                                                <td>{{ $meetingDetails['meeting']->total_attendance }}</td>
                                                <td>{{ ceil((strtotime($meetingDetails['meeting']->end_time) - strtotime($meetingDetails['meeting']->start_time)) / (60 * 60 ))}} Hour(s)</td>
                                                <td>{{ $meetingDetails['reports']['count'] }}</td>
                                                <td>{{ $meetingDetails['matters']['count'] }}</td>
                                                <td>{{ $meetingDetails['tasks']['count'] }}</td>
                                                <!-- <td class="text-right"><a href="{{ route('get-meeting-details', ['id' => $meetingDetails['meeting']->id]) }}">details</a></td>
                                                <td class="text-right"><a href="{{ route('get-meeting-details', ['id' => $meetingDetails['meeting']->id]) }}">download minutes</a></td>
                                                <td class="text-right"><a href="{{ route('get-meeting-details', ['id' => $meetingDetails['meeting']->id]) }}">send minutes</a></td> -->
                                                <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ::
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('get-meeting-details', ['meeting' => $meetingDetails['meeting']->id]) }}">details</a>
                                                    <a class="dropdown-item" href="{{ route('get-meeting-details', ['meeting' => $meetingDetails['meeting']->id]) }}">download minutes</a>
                                                    <a class="dropdown-item" href="{{ route('get-meeting-details', ['meeting' => $meetingDetails['meeting']->id]) }}">send minutes</a>
                                                    </div>
                                                    </div>
                                                </td>
                                               
                                            </tr>
                                        @endforeach
                                        @endif
                                        {{ $links }}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Craaser. Made with love in Lagos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endsection
