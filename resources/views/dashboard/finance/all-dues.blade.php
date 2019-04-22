@extends('dashboard.base')

@section('content')
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Dues</h2>
                                        <div class="overview-wrap">
                                            <a class="au-btn au-btn-icon au-btn--blue btn-secondary" href="{{ route('show-record-collection', ['collection_type' => 'dues']) }}">
                                            <i class="zmdi zmdi-plus"></i>collect dues</a>
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
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Dues</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>Period</th>
                                                <th>Paid</th>
                                                <th>Balance</th>
                                                <th>Collected on</th>
                                                <th class="text-right"></th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if (empty($dues))
                                            <tr>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td class="text-right">---</td>
                                                
                                            </tr>
                                        @else
                                        @foreach ($dues as $collection)
                                            <tr>
                                                <td>
                                                <a href="{{ route('single-member', ['member' => $collection->member()->first()->id]) }}">
                                                {{ $collection->member()->first()->fullname }} </a>
                                                </td>
                                                <td>{{ $collection->start_period == null ? "No period" : $collection->getStartPeriod()}} 
                                                    @if($collection->end_period)
                                                    -  {{ $collection->getEndPeriod() }}
                                                    @endif
                                                </td>
                                                <td>{{ $collection->getReceived() }}</td>
                                                <td>{{ $collection->getBalance() }}</td>
                                                <td>{{ $collection->collection_date == null ? "Not Collected" : $collection->getCollectionDate()}}</td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                    <a class="btn btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    ::
                                                    </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <a class="dropdown-item" href="{{ route('show-edit-collection', ['collection' => $collection->id]) }}">edit</a>
                                                        <a class="dropdown-item" href="{{ route('delete-collection', ['meeting' => $collection->id]) }}">delete</a>
                                                        </div>
                                                    </div>
                                                </td>
                                               
                                            </tr>
                                        @endforeach
                                        @endif
                                        {{ $dues->links() }}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            
                        @include('dashboard.footer')
                    </div>
                </div>
                @endsection