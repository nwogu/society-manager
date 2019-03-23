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
                        <h2 class="title-1">Edit Matter</h2>
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
            <form action="{{ route('edit-matter', ['matter' => $matter->id])}}" method="post" class="form-horizontal">
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Matter Details</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsInvalid" class=" form-control-label">Raised By</label>
                                            <select type="text" id="frequency" name="raised_by" class="form-control select2" required>
                                            @foreach($members as $member)
                                            <option value="{{ $member->id }}" {{$matter->raisedBy->id == $member->id ? 'selected' : ''}}> {{ $member->firstname }} {{ $member->lastname }}</option>
                                            @endforeach </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputIsInvalid" class=" form-control-label">Meetings Treated</label>
                                            <select type="text" id="frequency" name="meetings[]" class="form-control select2" multiple="multiple" required>
                                            @foreach($meetings as $meeting)
                                            @if($matter->meetings()->where('meeting_id', $meeting->id)->exists())
                                            <option value="{{ $meeting->id }}" selected> {{ $meeting->name }}</option>
                                            @else
                                            <option value="{{ $meeting->id }}"> {{ $meeting->name }}</option>
                                            @endif
                                            @endforeach </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsInvalid" class=" form-control-label">Status</label>
                                            <select type="text" id="frequency" name="status" class="form-control select2" required>
                                            @foreach($statuses as $status)
                                            <option value="{{ $status }}" {{$matter->status == $status ? 'selected' : ''}}> {{ $status }}</option>
                                            @endforeach </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Matter</label>
                                            <input type="text" id="campaignName" name="matter" class=" form-control-success form-control" value="{{ $matter->matter }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="body" class="control-label mb-1">Details</label>
                                            <textarea name="details" type="text" class="form-control" aria-required="fasle" aria-invalid="false">{{ $matter->details }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Matter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
                
            @include('dashboard.footer')
        </div>
    </div>
    @endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<script type="text/javascript">
        const editor = CKEDITOR.replace( 'editor1', {
    customConfig: ''
    } );
    </script>


@endsection