@extends('layout.app')
@section('title',$title)
@section('content')

<!-- Dashboard Content Section start -->
<section class="dashboard-content pt-120 mb-60">
    <div class="overlay">
        
        <div class="container">
            <div class="row justify-content-center">
                
                <div class="col-xl-9 col-lg-8">
                    <div class="tab-content">

                        <div class="tab-pane fade show active" id="topup" role="tabpanel" aria-labelledby="topup-tab">
                            <div class="row">
                                
                                <div class="col-12">
                                    <h5 class="title">Schedule</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">First Team Name</th>
                                                    <th scope="col">Second Team Name</th>
                                                    <th scope="col">Start Date/Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- {{liveMatch()}} --}}
                                               @if(isset($upcoming_match) && $upcoming_match != null)
                                               @foreach($upcoming_match as $key=>$value)
                                                 <tr>
                                                    <th scope="row">{{$value->team_name_1}}</th>
                                                    <td>{{$value->team_name_2}}</td>
                                                    <td>{{date('d-m-y H:i:s',strtotime($value->start_date_time))}}</td>
                                                   
                                                </tr>
                                               @endforeach
                                               @endif
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Dashboard Content Section end -->


@endsection