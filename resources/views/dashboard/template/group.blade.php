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
                        <h2 class="title-1">Group Templates</h2>
                        <div class="overview-wrap">
                            <button class="au-btn au-btn-icon au-btn--blue btn-secondary" data-toggle="modal" data-target="#addTemplate">
                            <i class="zmdi zmdi-plus"></i>create group</button>
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
                                    <h2>{{ $totalTemplate }}</h2>
                                    <span>Total Templates</span>
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
                                    <h2>{{ $totalSmsTemplate }}</h2>
                                    <span>Total Sent</span>
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
                                    <h2>{{ $totalEmailTemplate }}</h2>
                                    <span>Total Defaults</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            @if (!$groupTemplates->isEmpty())
            @foreach ($groupTemplates as $template)
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left">
                            {{$template->name}}
                            </div>
                            <div class="float-right">
                                <a href="{{ route('edit-group-template', ['groupTemplate' => $template->id])}}" class="btn btn-primary btn-sm">edit</a>
                                <a href="{{ route('confirm-delete-group-template', ['groupTemplate' => $template->id])}}" class="btn btn-danger btn-sm">delete</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <h5 class="text-sm mt-2 mb-1"></h5>
                                <div class="location float-left">
                                @foreach($template->messages as $message)
                                <p>{{ $message->name }}</p>
                                @endforeach
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
                                    No Group Templates</div>
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
			<div class="modal fade" id="addTemplate" tabindex="-1" role="dialog" aria-labelledby="addTemplatemodalLabel" aria-hidden="true">
				<div class="modal-dialog modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="scrollmodalLabel">Create Group Template</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action="{{ route('create-group-template') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="templateName" class="control-label mb-1">Template Name</label>
                                    <input id="templateName" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>
                                <div class="form-group">
                                <label for="templates" class="control-label mb-1">Choose Templates</label>
                                <select class="select2 form-control" name="templates[]" multiple="multiple" required>
                                    @foreach ( $company->emailTemplates as $emailTemplate)
                                    <option value="{{$emailTemplate->id}}">{{$emailTemplate->name}}</option>
                                    @endforeach
                                </select>
                                </div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
							<button type="submit" class="btn btn-primary">Create Group</button>
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

<script>
    var deleteButton = $('.delete-button');
    deleteButton.on('click', function(e) {
    var url = $('#delete-button').attr('url');
    e.preventDefault();
        if (confirm('Are you sure you want to delete this template?')) {
            window.location.href = url;
        }
    });
</script>


@endsection