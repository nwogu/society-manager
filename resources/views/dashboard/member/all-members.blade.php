@extends('dashboard.base')

@section('content')
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Members</h2>
                                        <div class="overview-wrap">
                                            <a class="au-btn au-btn-icon au-btn--blue btn-secondary" href="{{ route('show-add-member') }}">
                                            <i class="zmdi zmdi-plus"></i>Add New Member</a>
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
                        @if (!$members->isEmpty())
                        @foreach ($members as $member)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">
                                        <a href="{{ route('single-member', ['member' => $member->id])}}">
                                        {{$member->firstname}} {{$member->lastname}}
                                        </a>
                                        </strong>
                                        <small>
                                                @if($member->isExecutive($generalData['id']))
                                                <span class="badge badge-danger float-right mt-1">{{$member->role($generalData['id'])->role}}</span>
                                                @else
                                                <span class="badge badge-primary float-right mt-1">{{$member->role($generalData['id'])->role ?? "Not Assigned"}}</span>
                                                @endif
                                            </small>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <h5 class="text-sm-center mt-2 mb-1">{{$member->phone}}</h5>
                                            <h5 class="text-sm-center mt-2 mb-1">Last Attendance: <br>
                                            @if($member->lastMeeting($generalData['id']) != null)
                                            {{ date('l, d M Y', strtotime($member->lastMeeting($generalData['id']))) }}</h5>
                                            @endif
                                            <div class="location text-sm-center">
                                                {{$member->email}}</div>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a href="#" class="btn btn-success btn-sm">
                                                        Send Message
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ route('show-edit-member', ['member' => $member->id]) }}" class="btn btn-primary btn-sm">
                                                        Edit Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <h5 class="text-sm-center mt-2 mb-1"></h5>
                                            <div class="location text-sm-center">
                                                No Members Saved</div>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        </div>
                            {{$members->links()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Society Manager. Made by Gabriel: 08137507119</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endsection
