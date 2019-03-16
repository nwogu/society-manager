@extends('dashboard.base')

@section('content')
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Review</h2>
                                    
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
                                                <h2>{{ $total }}</h2>
                                                <span>Total Review</span>
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
                                                <h2>{{ $average }}</h2>
                                                <span>Average Rating</span>
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
                                                <h2>{{ $bad }}</h2>
                                                <span>Bad Review</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                         <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mx-auto d-block">
                                            
                                            <h5 class="text-sm-center mt-2 mb-1">Your Review Page</h5>
                                            <div class="location text-sm-center">
                                                <a href="{{route('company-review-page', ['slug' => $company->slug])}}">{{route('company-review-page', ['slug' => $company->slug])}}</a></div>
                                        </div>
                                        <hr>
                                        <div class="card-text text-sm-center">
                                            <a href="http://www.facebook.com/sharer.php?u={{route('company-review-page', ['slug' => $company->slug])}}">
                                                <i class="">facebook</i>
                                            </a> | 
                                            <a href="http://twitter.com/share?url={{route('company-review-page', ['slug' => $company->slug])}}">
                                                <i class="">twitter</i>
                                            </a>
                                           
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <strong class="card-title mb-3">Share With Your Customers</strong>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">All Reviews</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
                                                <th>Rating</th>
                                                <th>Email</th>
                                                <th>Published</th>
                                                <th class="text-right"></th>
                                                <th class="text-right"></th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if ($company->reviews->isEmpty())
                                            <tr>
                                                <td>---</td>
                                                <td>---</td>
                                                <td>---</td>
                                                <td class="text-right">---</td>
                                                <td class="text-right">---</td>
                                                
                                            </tr>
                                        @else
                                        @foreach ($company->reviews as $review)
                                            <tr>
                                                <td>{{ $review->rating }}</td>
                                                <td>{{ $review->email }}</td>
                                                @if ($review->published == 1)
                                                <td>Yes</td>
                                                @else
                                                <td>No</td>
                                                @endif
                                                @if ($review->published == 1)
                                                <td class="text-right"><a href="{{ route('publish-review', ['id' => $review->id]) }}">unpublish</a></td>
                                                @else
                                                <td class="text-right"><a href="{{ route('publish-review', ['id' => $review->id]) }}">publish</a></td>
                                                @endif
                                                <td class="text-right"><a href="{{ route('confirm-delete-review', ['id' => $review->id]) }}">delete</a></td>
                                               
                                            </tr>
                                        @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            Low Ratings</h3>
                                        
                                    </div>
                                    <div class="au-task js-list-load">
                                        <div class="au-task__title">
                                            <p>Customers who rated between 1 and 3</p>
                                        </div>
                                        <div class="au-task-list js-scrollbar3">
                                        @if (count($low) < 1)
                                        <div class="au-task__item au-task__item--danger">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">No Available Data</a>
                                                        
                                                    </h5>
                                                    <span class="time"></span>
                                                    
                                                    
                                                </div>
                                            </div>  
                                        @else  
                                        @foreach ($low as $lows)
                                        @if($lows->rating == 3)
                                            <div class="au-task__item au-task__item--danger">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="mailto:{{$lows->email}}">{{$lows->review}}</a>
                                                    </h5>
                                                    <span class="time">{{$lows->name}}</span>
                                                    <br>
                                                    <span class="time">{{$lows->email}}</span>
                                                </div>
                                            </div>
                                        @elseif($lows->rating === 2)
                                        <div class="au-task__item au-task__item--warning js-load-item">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="mailto:{{$lows->email}}">{{$lows->review}}</a>
                                                    </h5>
                                                    <span class="time">{{$lows->name}}</span>
                                                    <br>
                                                    <span class="time">{{$lows->email}}</span>
                                                </div>
                                            </div>
                                        @else
                                        <div class="au-task__item au-task__item--primary">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                    <a href="mailto:{{$lows->email}}">{{$lows->review}}</a>
                                                    </h5>
                                                    <span class="time">{{$lows->name}}</span>
                                                    <br>
                                                    <span class="time">{{$lows->email}}</span>
                                                </div>
                                            </div>
                                        @endif

                                      
                                        @endforeach
                                        @endif
                                  
                                        </div>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            Great Ratings</h3>
                                        
                                    </div>
                                    <div class="au-task js-list-load">
                                        <div class="au-task__title">
                                            <p>Customers who rated between 4 and 5</p>
                                        </div>
                                        <div class="au-task-list js-scrollbar3">
                                        @if (count($great) < 1)
                                            <div class="au-task__item au-task__item--primary">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="#">No Data Available</a>
                                                    </h5>
                                                    <span class="time"></span>
                                                </div>
                                            </div>
                                        @else
                                        @foreach ($great as $greats)
                                        @if($greats->rating == 5)
                                            <div class="au-task__item au-task__item--success">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="mailto:{{$greats->email}}">{{$greats->review}}</a>
                                                    </h5>
                                                    <span class="time">{{$greats->name}}</span>
                                                    <br>
                                                    <span class="time">{{$greats->email}}</span>
                                                </div>
                                            </div>
                                        @else
                                            <div class="au-task__item au-task__item--primary">
                                                <div class="au-task__item-inner">
                                                    <h5 class="task">
                                                        <a href="mailto:{{$greats->email}}">{{$greats->review}}</a>
                                                    </h5>
                                                    <span class="time">{{$greats->name}}</span>
                                                    <br>
                                                    <span class="time">{{$greats->email}}</span>
                                                </div>
                                            </div>
                                        @endif
                                        @endforeach
                                        @endif
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Craaser. Made with love in Lagos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endsection
