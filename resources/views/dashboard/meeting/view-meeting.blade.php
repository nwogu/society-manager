@extends('dashboard.base')

@section('content')
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">{{ $meeting['meeting']->name }}</h2>
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
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-left">
                                        {{$meeting['meeting']->name}}
                                        </div>
                                        <div class="float-right">
                                            <a href="{{ route('show-edit-meeting', ['meeting' => $meeting['meeting']->id])}}" class="btn btn-primary btn-sm">edit</a>
                                            <a href="{{ route('confirm-delete-meeting', ['meeting' => $meeting['meeting']->id])}}" class="btn btn-primary btn-sm">delete</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <h5 class="text-sm mt-2 mb-1"></h5>
                                            <div class="location ">
                                                <h5>Minutes</h5>
                                                {!!$meeting['meeting']->minute!!}
                                            </div>
                                            <hr>
                                            <div class="location ">
                                                <h5>Attendance</h5>
                                                @foreach($meeting['meeting']->attendances as $attendant)
                                                {{ $attendant->firstname}} {{ $attendant->lastname}}
                                                @endforeach
                                            </div>
                                            <hr>
                                            <div class="location ">
                                                <h5>Matters Arising</h5>
                                                {!!$meeting['meeting']->minute!!}
                                            </div>
                                        </div>
                                    </div>
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
