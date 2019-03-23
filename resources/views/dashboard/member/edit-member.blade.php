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
                        <h2 class="title-1">Edit Member</h2>
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
            <form action="{{ route('edit-member', ['member' => $user->id])}}" method="post" class="form-horizontal">
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Member Details</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">First Name</label>
                                            <input type="text" id="campaignName" name="firstname" class=" form-control-success form-control" value="{{$user->firstname}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputIsInvalid" class=" form-control-label">Role</label>
                                            <select type="text" id="frequency" name="role" class="form-control select2" required>
                                            @foreach($roles as $role)
                                            @if(($user->role($generalData['id']) ? $user->role($generalData['id'])->id : null) == $role->id)
                                            <option value="{{ $role->id }}" selected> {{ $role->role }}</option>
                                            @else
                                            <option value="{{ $role->id }}"> {{ $role->role }}</option>
                                            @endif
                                            @endforeach </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Last Name</label>
                                            <input type="text" id="campaignName" name="lastname" class=" form-control-success form-control" value="{{$user->lastname}}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Email</label>
                                            <input type="text" id="campaignName" name="email" class=" form-control-success form-control" value="{{$user->email}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Password</label>
                                            <input type="password" id="campaignName" name="password" class=" form-control-success form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Confirm Password</label>
                                            <input type="password" id="campaignName" name="password_confirmation" class=" form-control-success form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Date of Birth</label>
                                            <input type="date" id="campaignName" name="dob" class=" form-control-success form-control" 
                                            @if($user->dob != null)
                                            value="{{ date( 'Y-m-d', strtotime($user->dob)) }}"
                                            @endif
                                            >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Phone</label>
                                            <input type="text" id="campaignName" name="phone" class=" form-control-success form-control" value="{{ $user->phone}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsInvalid" class=" form-control-label">Sex</label>
                                            <select type="text" id="frequency" name="sex" class="form-control select2">
                                            @foreach($sexes as $sex)
                                            @if($user->sex == $sex)
                                            <option value="{{ $sex }}" selected> {{ $sex }}</option>
                                            @else
                                            <option value="{{ $sex }}"> {{ $sex }}</option>
                                            @endif
                                            @endforeach </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Date Joined</label>
                                            <input type="date" id="campaignName" name="joined" class=" form-control-success form-control" 
                                            @if($user->pivot->joined != null)
                                            value="{{ date( 'Y-m-d', strtotime($user->pivot->joined)) }}"
                                            @endif
                                            >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="body" class="control-label mb-1">Address</label>
                                            <textarea name="address" type="text" class="form-control" aria-required="fasle" aria-invalid="false">{{ $user->address }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Member</button>
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
