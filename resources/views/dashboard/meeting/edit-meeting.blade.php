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
                        <h2 class="title-1">Edit Meeting</h2>
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
            <form action="{{ route('edit-meeting', ['meeting' => $meeting->id])}}" method="post" class="form-horizontal">
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Meeting Details</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Meeting Date</label>
                                            <input type="date" id="campaignName" name="meeting_date" class=" form-control-success form-control" 
                                            @if($meeting->meeting_date != null)
                                            value="{{ date( 'Y-m-d', strtotime($meeting->meeting_date)) }}"
                                            @endif
                                            >
                                            required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputIsInvalid" class=" form-control-label">Type</label>
                                            <select type="text" id="frequency" name="type" class="form-control select2" required>
                                            @foreach($types as $type)
                                            @if($type == $meeting->type)
                                            <option value="{{ $type }}" selected> {{ $type }}</option>
                                            @else
                                            <option value="{{ $type }}"> {{ $type }}</option>
                                            @endif
                                            @endforeach </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class=" form-group">
                                            <label for="taget" class=" form-control-label">Presider</label>
                                            <select type="text" id="target" name="presider" class="form-control select2" required>
                                            @foreach($users as $user)
                                            @if($user->id == $meeting->presider()->first()->id)
                                            <option value="{{ $user->id }}" selected> {{ $user->firstname }} {{ $user->lastname }}</option>
                                            @else
                                            <option value="{{ $user->id }}"> {{ $user->firstname }} {{ $user->lastname }}</option>
                                            @endif
                                            @endforeach </select>
                                        </div>
                                        <div class=" form-group">
                                            <label for="message" class="form-control-label">Attendees</label>
                                            <select name="attendance[]" class="form-control select2" multiple="multiple" id="select2" required>
                                            @foreach($users as $user)
                                            @if($meeting->attendances()->where('user_id', $user->id)->exists())
                                            <option value="{{ $user->id }}" selected> {{ $user->firstname }} {{ $user->lastname }}</option>
                                            @else
                                            <option value="{{ $user->id }}"> {{ $user->firstname }} {{ $user->lastname }}</option>
                                            @endif
                                            @endforeach </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Start Time</label>
                                            <input type="time" id="campaignName" name="start_time" class=" form-control-success form-control" 
                                            @if($meeting->start_time != null)
                                            value="{{ date( 'H:i:s', strtotime($meeting->start_time)) }}"
                                            @endif
                                            >
                                            required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">End Time</label>
                                            <input type="time" id="campaignName" name="end_time" class=" form-control-success form-control" 
                                            @if($meeting->end_time != null)
                                            value="{{ date( 'H:i:s', strtotime($meeting->end_time)) }}"
                                            @endif
                                            >
                                            required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="body" class="control-label mb-1">Minutes</label>
                                            <textarea id="editor1" name="minute" type="text" class="form-control" aria-required="fasle" aria-invalid="false">
                                            {!! $meeting->minute !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Meeting</button>
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
