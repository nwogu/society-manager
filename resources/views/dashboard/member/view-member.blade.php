@extends('dashboard.base')

@section('content')
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">{{ $member->firstname }} {{ $member->lastname }}</h2>
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
                                        {{$member->firstname}} {{$member->lastname}}
                                        </div>
                                        <div class="float-right">
                                                <div class="dropdown">
                                                <a class="btn btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                more
                                                </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('show-edit-member', ['member' => $member->id]) }}">edit</a>
                                                    <a class="dropdown-item" href="{{ route('confirm-remove-member', ['member' => $member->id]) }}">remove</a>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <h5 class="text-sm mt-2 mb-1"></h5>
                                            <div class="location ">
                                                <h5>Contacts</h5>
                                                {{ $member->email}}, {{ $member->phone}}
                                            </div>
                                            <hr>
                                            <div class="location ">
                                                <h5>Address</h5>
                                                {{ $member->address }}
                                            </div>
                                            <hr>
                                            <div class="location ">
                                                <h5>Role / Joined</h5>
                                                {{ $member->role($generalData['id'])->role }}, Joined on: 
                                                @if($member->pivot->joined != null)
                                                {{date( 'd M,Y', strtotime($member->pivot->joined))}}
                                                @endif
                                            </div>
                                            <hr>
                                            <div class="location ">
                                                <h5>Date of Birth / Sex </h5>
                                                @if($member->dob != null)
                                                {{date( 'd M,Y', strtotime($member->dob))}}, 
                                                @endif
                                                {{ ucwords($member->sex)}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
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

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
