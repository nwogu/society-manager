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
                        <h2 class="title-1">Contacts</h2>
                        <div class="overview-wrap">
                            <button class="au-btn au-btn-icon au-btn--blue btn-secondary" data-toggle="modal" data-target="#addContact">
                            <i class="zmdi zmdi-plus"></i>add contact</button>
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
                                    <h2>{{ $totalContact }}</h2>
                                    <span>Total Contacts</span>
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
                                    <h2>{{ $totalProspect }}</h2>
                                    <span>Total Prospects</span>
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
                                    <h2>{{ $totalLukewarm }}</h2>
                                    <span>Total Lukewarm</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            @if (!$company->contacts->isEmpty())
            @foreach ($company->contacts as $contact)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">{{$contact->firstname}} {{$contact->lastname}}
                            </strong>
                            <small>
                                    @if($contact->status->name == 'prospect')
                                    <span class="badge badge-primary float-right mt-1">{{$contact->status->name}}</span>
                                    @elseif($contact->status->name == 'lead')
                                    <span class="badge badge-primary float-right mt-1">{{$contact->status->name}}</span>
                                    @elseif($contact->status->name == 'client')
                                    <span class="badge badge-success float-right mt-1">{{$contact->status->name}}</span>
                                    @else
                                    <span class="badge badge-danger float-right mt-1">{{$contact->status->name}}</span>
                                    @endif
                                </small>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <h5 class="text-sm-center mt-2 mb-1">{{$contact->phone}}</h5>
                                <div class="location text-sm-center">
                                    {{$contact->email}}</div>
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
                                        <a href="{{ route('change-status', ['contact' => $contact])}}" class="btn btn-primary btn-sm">
                                        @if ($contact->status->name == 'prospect')
                                            Mark as Lead
                                        @elseif ($contact->status->name == 'lead')
                                            Mark as Client
                                        @elseif ($contact->status->name == 'client')
                                            Mark Lukewarm
                                        @else
                                            Mark Prospect
                                        @endif
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
                                    No Contacts Saved</div>
                            </div>
                            <hr>
                            <div class="card-text text-sm-center">
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>

    <!-- modal scroll -->
			<div class="modal fade" id="addContact" tabindex="-1" role="dialog" aria-labelledby="addContactmodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="scrollmodalLabel">Add Contact</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{ route('add-contact') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="first_name" class="control-label mb-1">First Name</label>
                                    <input id="first_name" name="firstName" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="control-label mb-1">Last Name</label>
                                    <input id="last_name" name="lastName" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label mb-1">Email</label>
                                    <input id="email" name="email" type="email" class="form-control" aria-required="false" aria-invalid="false">
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="control-label mb-1">Phone Number</label>
                                    <input id="phone" name="phone" type="tel" class="form-control" aria-required="fasle" aria-invalid="false">
                                </div>
                                <div class="form-group">
                                    <label for="address" class="control-label mb-1">Address</label>
                                    <textarea id="address" name="address" type="text" class="form-control" aria-required="fasle" aria-invalid="false"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="control-label mb-1">Status</label>
                                    <select name="status" id="select" class="form-control select2">
                                        @foreach ($statuses as $status)
                                        <option value="{{ $status->name }}">{{$status->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Add</button>
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