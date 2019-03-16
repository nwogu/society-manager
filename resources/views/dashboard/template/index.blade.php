@extends('dashboard.base')

@section('content')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Templates</h2>
                        <div class="overview-wrap">
                            <button class="au-btn au-btn-icon au-btn--blue btn-secondary" data-toggle="modal" data-target="#addTemplate">
                            <i class="zmdi zmdi-plus"></i>add template</button>
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
            @if (!$emailTemplates->isEmpty())
            @foreach ($emailTemplates as $template)
            <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left">
                            {{$template->name}}
                            </div>
                            <div class="float-right">
                                <a href="{{ route('edit-template', ['template' => $template->id])}}" class="btn btn-primary btn-sm">edit</a>
                                <a href="{{ route('confirm-delete-template', ['template' => $template->id])}}" class="btn btn-danger btn-sm">delete</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <h5 class="text-sm mt-2 mb-1"></h5>
                                <div class="location float-left">
                                    <p>{{$template->subject}}</p>
                                    {!!$template->body!!}
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
                                    No Templates</div>
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
							<h5 class="modal-title" id="scrollmodalLabel">Add Template</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
                            <div class="panel ml-4 mb-4 mr-4 pt-3 pb-3 pl-3 pr-3 bg-info" id="keyword" style="color:white">
                                <h5 style="color:white">How Keywords Work</h5>
                                <button type="button" class="close" 
                                data-target="#keyword" 
                                data-dismiss="alert">
                                <span aria-hidden="true">&times;</span><span class="sr-only">x</span>
                                </button>
                                <p>Key words are used to represent particular personal information. A key word is always surrounded by double brackets.
                                Default keywords include: </p> <p> ((firstname)) ((lastname))</p>
                                <p>Key words can be used in the subject of a template, as well as in the message body.</p>

                            </div>
							<form action="{{ route('add-template') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="templateName" class="control-label mb-1">Template Name</label>
                                    <input id="templateName" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="control-label mb-1">Subject</label>
                                    <input id="subject" name="subject" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                </div>
                                <div class="form-group">
                                    <label for="body" class="control-label mb-1">Body</label>
                                    <textarea id="editor1" name="body" type="text" class="form-control" aria-required="fasle" aria-invalid="false" rows="10" cols="80"></textarea>
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
        const editor = CKEDITOR.replace( 'editor1', {
    customConfig: ''
    } );
    </script>

    <script>


var deleteButton = $('.delete-button');
deleteButton.on('click', function(e) {
    var url = $('.delete-button').attr('url');
    e.preventDefault();
        if (confirm('Are you sure you want to delete this template?')) {
            window.location.href = url;
            
        }
    });
</script>


@endsection