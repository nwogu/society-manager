@extends('dashboard.base')

@section('content')
<div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1">Edit Group Contact</h2>
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
            <!-- Edit Form -->
            <div class="row justify-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">{{$groupContact->name}}</h3>
                            </div>
                            <hr>
                            <form action="{{ route('update-group-contact', ['contact' => $groupContact]) }}" method="post" >
                                @csrf
                                <div class="form-group">
                                    <label for="templateName" class="control-label mb-1">Group Name</label>
                                    <input id="templateName" name="name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$groupContact->name}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="templates" class="control-label mb-1">Choose Members</label>
                                    <select class="select2 form-control" name="contacts[]" multiple="multiple" id="select2" required>
                                        @foreach ($company->contacts as $member)
                                        @if(in_array($member->firstname, $members))
                                        <option value="{{$member->id}}" selected>{{$member->firstname}} {{$member->lastname}}</option>
                                        @else
                                        <option value="{{$member->id}}">{{$member->firstname}} {{$member->lastname}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                <a href="{{ route('group-contacts') }}" class="btn btn-secondary">Cancel</a>
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
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<script>
    var deleteButton = $('.delete-button');
    deleteButton.on('click', function(e) {
    var url = $('#delete-button').attr('url');
    e.preventDefault();
        if (confirm('Are you sure you want to delete this group template?')) {
            window.location.href = url;
        }
    });
</script>


@endsection