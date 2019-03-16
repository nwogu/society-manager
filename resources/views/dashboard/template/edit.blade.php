@extends('dashboard.base')

@section('content')
<div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Edit Template</h2>
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
            <!-- Edit Form -->
            <div class="row justify-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">{{$template->name}}</h3>
                            </div>
                            <hr>
                            <form action="{{ route('update-template', ['template' => $template]) }}" method="post" >
                                @csrf
                                <div class="form-group">
                                    <label for="templateName" class="control-label mb-1">Template Name</label>
                                    <input id="templateName" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$template->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="control-label mb-1">Subject</label>
                                    <input id="subject" name="subject" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$template->subject}}">
                                </div>
                                <div class="form-group">
                                    <label for="body" class="control-label mb-1">Body</label>
                                    <textarea id="editor1" name="body" type="text" class="form-control" aria-required="fasle" aria-invalid="false" rows="10" cols="80">{{$template->body}}</textarea>
                                </div>
                                <div>
                                <a href="{{ route('templates') }}" class="btn btn-secondary">Cancel</a>
							    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Form-->
        </div>
    </div>
@endsection

@section('javascript')


<script type="text/javascript">
        const editor = CKEDITOR.replace( 'editor1', {
    customConfig: ''
    } );
    </script>


@endsection