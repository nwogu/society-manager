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
                                        {{$meeting['meeting']->name}} <br><b>start time:</b> {{date( 'h:i a', strtotime($meeting['meeting']->start_time))}} <br><b>end time:</b> {{date( 'h:i a', strtotime($meeting['meeting']->end_time))}}
                                        </div>
                                        <div class="float-right">
                                            <!-- <a href="{{ route('show-edit-meeting', ['meeting' => $meeting['meeting']->id])}}" class="btn btn-primary btn-sm">edit</a>
                                            <a href="{{ route('confirm-delete-meeting', ['meeting' => $meeting['meeting']->id])}}" class="btn btn-primary btn-sm">delete</a> -->
                                                <div class="dropdown">
                                                <a class="btn btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                more
                                                </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{ route('show-edit-meeting', ['meeting' => $meeting['meeting']->id]) }}">edit</a>
                                                    <a class="dropdown-item" href="{{ route('confirm-delete-meeting', ['meeting' => $meeting['meeting']->id]) }}">delete</a>
                                                    <a class="dropdown-item" href="{{ route('download-minute', ['meeting' => $meeting['meeting']->id]) }}">download minutes</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sendPersons">send minute to persons</a>
                                                    </div>
                                                </div>
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
                                                {{ $attendant->firstname}} {{ $attendant->lastname}}, 
                                                @endforeach
                                            </div>
                                            <hr>
                                            <div class="location ">
                                                <h5>Matters Arising</h5>
                                                @foreach($meeting['meeting']->matters as $matter)
                                                <a href="{{ route('get-single-matter', ['matter' => $matter->id])}}" style="padding-right:20px"> {{ $matter->matter}} </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        @include('dashboard.footer')
                    </div>
                </div>

                <!-- modal scroll -->
			<div class="modal fade" id="sendPersons" tabindex="-1" role="dialog" aria-labelledby="sendPersonsmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="scrollmodalLabel">Send Minutes</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{ route('send-minute-persons', ['meeting' => $meeting['meeting']->id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                <label for="message" class="form-control-label">Members</label>
                                <select name="members[]" class="form-control select2" multiple="multiple" id="select2">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}"> {{ $user->firstname }} {{ $user->lastname }}</option>
                                @endforeach </select>
                                </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Send Minutes</button>
						</div>
                        </form>
					</div>
				</div>
			</div>
			<!-- end modal scroll -->
                @endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@endsection
