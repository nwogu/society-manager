@extends('dashboard.base')

@section('content')
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Matters</h2>
                                        <div class="overview-wrap">
                                            <a class="au-btn au-btn-icon au-btn--blue btn-secondary" href="{{ route('show-create-matters') }}">
                                            <i class="zmdi zmdi-plus"></i>create new matter</a>
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
                        @if (!$matters->isEmpty())
                        @foreach ($matters as $matter)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title mb-3">
                                        <a href="{{ route('get-single-matter', ['matter' => $matter->id])}}">
                                        View Details
                                        </a>
                                        </strong>
                                        <small>
                                                <span class="badge 
                                                {{ $matter->status == 'resolved' ? 'badge-success' : ($matter->status == 'arising' ? 'badge-danger' : 'badge-primary') }} 
                                                float-right mt-1">{{$matter->status}}</span>
                                            </small>
                                    </div>
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            <h5 class="text-sm-center mt-2 mb-1">{{$matter->matter}}</h5>
                                            <h5 class="text-sm-center mt-2 mb-1">
                                            @if($matter->raised_by != null)
                                            Raised By: <br>
                                            {{ $matter->raisedBy->firstname }} {{ $matter->raisedBy->lastname }}</h5>
                                            @endif
                                            <div class="location text-sm-center">
                                                Treated in {{$matter->meetings()->count() ?? 0}} Meeting(s)</div>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <div class="row">
                                                <div class="col-6">
                                                    <a href="#" class="btn btn-success btn-sm" data-target="#addMeetings" data-toggle="modal">
                                                        Add To Meeting
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ route('toggle-matter-status', ['matter' => $matter->id])}}" class="btn btn-primary btn-sm">
                                                        Toggle Status
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
                                                No Matters Created</div>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        </div>
                            {{$matters->links()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Society Manager. Made by Gabriel: 08137507119</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal scroll -->
			<div class="modal fade" id="addMeetings" tabindex="-1" role="dialog" aria-labelledby="addMeetingsmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="scrollmodalLabel">Add To Meeting</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{ route('add-matter-to-meeting', ['matter' => $matter->id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                <label for="message" class="form-control-label">Meetings</label>
                                <select name="meetings[]" class="form-control select2" multiple="multiple" id="select2">
                                @foreach($meetings as $meeting)
                                <option value="{{ $meeting->id }}"> {{ $meeting->name }}</option>
                                @endforeach </select>
                                </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Add Meetings</button>
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
