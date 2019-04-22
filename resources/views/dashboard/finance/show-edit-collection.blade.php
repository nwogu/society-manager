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
                        <h2 class="title-1">Update Collection</h2>
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
            <form action="{{ route('edit-collection', ['collection' => $collection->id])}}" method="post" class="form-horizontal">
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Collection Details For {{ $collection->member()->first()->fullname }}</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Collection Type</label>
                                            <select type="text" id="type" name="type" class=" form-control-success form-control select2" value="{{ $collection->type }}" required>
                                                @foreach($collectionTypes as $type)
                                                <option value="{{$type}}"
                                                @if($collection->type == $type)
                                                selected
                                                @endif
                                                > {{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputIsInvalid" class=" form-control-label">Members</label>
                                            <select type="text" id="members" name="member" class="form-control select2" required>
                                            @foreach($society->users as $member)
                                            <option value="{{ $member->id }}"
                                                @if($collection->member()->first()->id == $member->id)
                                                selected
                                                @endif
                                                > {{ $member->fullname }}</option>
                                            @endforeach </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Amount</label>
                                            <input type="text" id="campaignName" name="amount" class=" form-control-success form-control" value="{{ $collection->amount }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Description</label>
                                            <input type="text" id="campaignName" name="description" class=" form-control-success form-control" value="{{ $collection->description }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Collection Date</label>
                                            <input type="date" id="campaignName" name="collection_date" class=" form-control-success form-control" value="{{ $collection->collection_date == null ?: $collection->collection_date->format('Y-m-d') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Received</label>
                                            <input type="text" id="campaignName" name="received" class=" form-control-success form-control" value="{{ $collection->received }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Start Period</label>
                                            <input type="date" name="start_period" class=" form-control-success form-control" value="{{ $collection->start_period == null ?: $collection->start_period->format('Y-m-d') }}">
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="inputIsInvalid" class=" form-control-label">Affliated Meeting (Not Required)</label>
                                            <select type="text" id="frequency" name="meeting_id" class="form-control select2">
                                            @foreach($society->meetings as $meeting)
                                            <option value="{{ $meeting->id }}"> {{ $meeting->name }}</option>
                                            @endforeach </select>
                                        </div> -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">End Period</label>
                                            <input type="date" name="end_period" class=" form-control-success form-control" value="{{ $collection->end_period == null ?: $collection->end_period->format('Y-m-d') }}">
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="inputIsInvalid" class=" form-control-label">Affiliated Commitee (Not Required)</label>
                                            <select type="text" id="frequency" name="commitee_id" class="form-control select2">
                                            @foreach($society->meetings as $meeting)
                                            <option value="{{ $meeting->id }}"> {{ $meeting->name }}</option>
                                            @endforeach </select>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Collection</button>
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


@endsection