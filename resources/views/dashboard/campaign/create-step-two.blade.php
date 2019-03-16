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
                        <h2 class="title-1">Create Campaign</h2>
                        <div class="overview-wrap">
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
                                    <h2>{{ $totalCampaign }}</h2>
                                    <span>Total Campaigns</span>
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
                                    <h2>{{ $activeCampaign }}</h2>
                                    <span>Active Campaigns</span>
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
                                    <h2>{{ $pausedCampaign }}</h2>
                                    <span>Paused Campaigns</span>
                                </div>
                            </div>
                            <div class="overview-chart">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DATA TABLE -->
            <form action="#" method="post" class="form-horizontal">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Campaign Details</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputIsValid" class=" form-control-label">Campaign Name</label>
                                            <input type="text" id="campaignName" name="name" class=" form-control-success form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputIsInvalid" class=" form-control-label">Frequency</label>
                                            <select type="text" id="frequency" name="frequency" class="form-control select2" required>
                                            <option value="placeholder"> Select Frequency </option>
                                            <option value="once"> Once </option>
                                            <option value="recurring"> Recurring</option> </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class=" form-group">
                                            <label for="taget" class=" form-control-label">Target Options</label>
                                            <select type="text" id="target" name="target_type" class="form-control select2" required>
                                            <option value="placeholder"> Target By</option>
                                            <option value="status"> Status</option>
                                            <option value="group"> Group</option>
                                            <option value="contact"> Contact</option> </select>
                                        </div>
                                        <div class=" form-group">
                                            <label for="message" class=" form-control-label">Message Options</label>
                                            <select type="text" id="target" name="message_type" class="form-control select2" required>
                                            <option value="placeholder"> Message With</option>
                                            <option value="group_template"> Group Template</option>
                                            <option value="single_template"> Single Template</option>
                                            <option value="compose_new"> Compose New</option> </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <strong>Target Details</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class=" form-group">
                                    <label for="taget" class=" form-control-label">Target By</label>
                                    <select type="text" id="target" name="target_type" class="form-control select2" required>
                                    <option value="placeholder"> Target By</option>
                                    <option value="status"> Status</option>
                                    <option value="group"> Group</option>
                                    <option value="contact"> Contact</option> </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <strong>Message Details</strong>
                            </div>
                            <div class="card-body card-block">
                                <div class="has-success form-group">
                                    <label for="inputIsValid" class=" form-control-label">Message</label>
                                    <input type="text" id="inputIsValid" class="is-valid form-control-success form-control">
                                </div>
                                <div class="has-warning form-group">
                                    <label for="inputIsInvalid" class=" form-control-label">Channel</label>
                                    <input type="text" id="inputIsInvalid" class="is-invalid form-control">
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </form>
            <!-- END DATA TABLE -->
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