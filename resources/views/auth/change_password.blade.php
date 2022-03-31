@extends('layout.app')
@section('title',$title)
@section('content')

<!-- Dashboard Content Section start -->
<section class="dashboard-content pt-120">
    <div class="overlay">
        <div class="dashboard-heading">
            <div class="container">
                <div class="row justify-content-lg-end justify-content-between">
                    <div class="col-xl-9 col-lg-12">
                        <ul class="nav" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a href="{{route('front.auth.dashboard')}}"><button class="nav-link {{$dashboard}}" id="dashboard-tab" data-bs-toggle="tab"
                                    data-bs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                                    aria-selected="false">dashboard</button></a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{$setting_class}}" id="setting-tab" data-bs-toggle="tab"
                                    data-bs-target="#setting" type="button" role="tab" aria-controls="setting"
                                    aria-selected="true">setting</button>
                            </li>
                             <li class="nav-item" role="presentation">
                                  <a href="{{route('front.auth.topup_history')}}"><button class="nav-link {{$top_up_class}}" id="topup-tab" data-bs-toggle="tab"
                                    data-bs-target="#topup" type="button" role="tab" aria-controls="topup"
                                    aria-selected="true">Top Up History</button></a>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <button class="nav-link" id="my-bets-tab" data-bs-toggle="tab" data-bs-target="#my-bets"
                                    type="button" role="tab" aria-controls="my-bets" aria-selected="false">my
                                    bets</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="deposit-tab" data-bs-toggle="tab" data-bs-target="#deposit"
                                    type="button" role="tab" aria-controls="deposit"
                                    aria-selected="false">deposit</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="withdraw-tab" data-bs-toggle="tab"
                                    data-bs-target="#withdraw" type="button" role="tab" aria-controls="withdraw"
                                    aria-selected="false">withdraw</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="buy-crypto-tab" data-bs-toggle="tab"
                                    data-bs-target="#buy-crypto" type="button" role="tab" aria-controls="buy-crypto"
                                    aria-selected="false">buy crypto</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="affiliate-tab" data-bs-toggle="tab"
                                    data-bs-target="#affiliate" type="button" role="tab" aria-controls="affiliate"
                                    aria-selected="false">affiliate</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="transactions-tab" data-bs-toggle="tab"
                                    data-bs-target="#transactions" type="button" role="tab" aria-controls="transactions"
                                    aria-selected="false">transactions</button>
                            </li> --}}
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="dashboard-sidebar">
                        <div class="single-item">
                            <h5>{{\Auth::guard('front_user')->user()->name}}</h5>
                            <p>{{\Auth::guard('front_user')->user()->email}}</p>
                            <p>Mobile: {{\Auth::guard('front_user')->user()->mobile}}</p>
                        </div>
                        <div class="balance">
                            <div class="single-item">
                                <h5>{{\Auth::guard('front_user')->user()->balance}} Rs.</h5>
                                <p>Current Balance</p>
                            </div>
                            
                        </div>
                        <div class="balance">
                            <div class="single-item">
                                <h5>{{\Auth::guard('front_user')->user()->signup_balance}} Rs.</h5>
                                <p>Top Up Balance</p>
                            </div>   
                        </div>
                        
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="tab-content">
                        <div class="tab-pane fade {{$dashboard}}" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                            <div class="row">
                                
                                <div class="col-12">
                                    <h5 class="title">My Match Bets</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Date/Time</th>
                                                    <th scope="col">Bet Value</th>
                                                    <th scope="col">Match Status</th>
                                                    <th scope="col">Winner</th>
                                                    <th scope="col">Wining/Loosing Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- {{liveMatch()}} --}}
                                                
                                                @if(isset($my_bets) && $my_bets != null )
                                                   

                                                @foreach($my_bets as $Key=>$value)
                                                 @php 
                                                    $match_id=matchDetail($value->eid);
                                                @endphp
                                                 @php 

                                                if ($value->win_lose==null && isset($match_id->live) && $match_id->status =='Finished') {
                                                    
                                                $bet_value=$value->bet_value;
                                                     $odd=$value->odd;
                                                     $add=($bet_value)*($odd);
                                                 if (isset($match_id->winner_team_id) && $match_id->winner_team_id == $value->team_id) {
                                                     $value->win_lose=1;
                                                     $value->win_amount=$add;
                                                     $value->save();

                                                     $user=\App\Models\FrontUser::where('id',\Auth::guard('front_user')->user()->id)->first();
                                                     $user->balance=($user->balance)+($add);
                                                     $user->save();
                                                 }else if(isset($match_id->status) && $match_id->status == 'Finished' && $match_id->winner_team_id != $value->team_id){

                                                    $value->win_lose=0;
                                                    $value->loose_amount=$add;
                                                    $value->save();
                                                 }

                                                 }
                                                @endphp
                                                <tr>
                                                    <th scope="row">{{$value->created_at}}</th>
                                                    <td>{{$value->bet_value}} Rs</td>
                                                    @if($match_id != null)
                                                    <td>{{$match_id->status}}</td>
                                                    @else
                                                    <td>Not Found</td>
                                                    @endif
                                                    <td>
                                                       @if(isset($match_id->status) && $match_id->status=="Finished" && $match_id->status=='Finished')
                                                        {!! teamData($match_id->winner_team_id)->name !!}
                                                       @else
                                                       Winner Not Yet
                                                       @endif
                                                   </td>
                                                   <td @if($value->win_lose==1) class="text-success" @else class="text-danger" @endif> @if($value->win_amount != null) +{{$value->win_amount}} @else -{{$value->loose_amount}}  @endif</td>
                                                   
                                                </tr>

                                               

                                                @endforeach
                                                @endif
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                 <div class="col-12 mb-40">
                                    <h5 class="title">My Bets Per Over</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Date/Time</th>
                                                    <th scope="col">Bet Value</th>
                                                    <th scope="col">Over Number</th>
                                                    <th scope="col">Winner</th>
                                                    <th scope="col">Wining/Loosing Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- {{liveMatch()}} --}}
                                                
                                                @if(isset($user_contest) && $user_contest != null )
                                                   

                                                @foreach($user_contest as $Key=>$value)

                                                 @php 
                                                 $match_detail=matchDetail($value->eid);
                                                 // dd($match_detail);
                                                 $is_valid=false;
                                                 $total_runs=0;
                                                 $count=0;
                                                 if ($value->over_number != '1-6') {
                                                 foreach ($match_detail->balls as $key => $val) {
                                                 
                                                    $over=ceil($val->ball);
                                                     if ($val->team_id== $value->team_id && $over==$value->over_number ) {
                                                        if (isset($val->score) &&$val->score != null) {
                                                            $total_runs += $val->score->runs;
                                                            $is_valid=true;
                                                            $count=$count+1;
                                                        }

                                                     }
                                                 }
                                                 // dd($count);
                                                    $bet_value=$value->balance;
                                                     $odd=$value->over_run_odd;
                                                     $add=($bet_value)*($odd);
                                                     $user=\App\Models\FrontUser::where('id',\Auth::guard('front_user')->user()->id)->first();
                                                  
                                                 if ($total_runs==$value->over_run && $is_valid==true && $value->win_lose == Null && $count==6 ) {
                                                    if ($value->yes_no==1) {  
                                                      $value->win_lose=1;
                                                     $value->win_amount=$add;
                                                     $value->save();
                                                     $you_win="You Win";
                                                     
                                                     $user->balance=($user->balance)+($add);
                                                     $user->save();
                                                    }else if($value->yes_no == 0){
                                                        $you_win="You Lose";
                                                        $value->win_lose=2;
                                                        $value->loose_amount=$add;
                                                        $value->save();
                                                    }
                                                 }else if($is_valid==true && $value->win_lose==null && $count==6 && $total_runs !=$value->over_run){
                                                    if ($value->yes_no==0) {  
                                                      $value->win_lose=1;
                                                     $value->win_amount=$add;
                                                     $value->save();
                                                     $you_win="You Win";
                                                     
                                                     $user->balance=($user->balance)+($add);
                                                     $user->save();
                                                    }else if($value->yes_no == 1){
                                                        $you_win="You Lose";
                                                        $value->win_lose=2;
                                                        $value->loose_amount=$add;
                                                        $value->save();
                                                    }
                                                 }else{
                                                    $you_win='Result Not Yet';
                                                 }

                                                }
                                                if ($value->over_number=='1-6') {
                                                    foreach ($match_detail->balls as $key => $val) {
                                                 
                                                        $over=ceil($val->ball);

                                                         if ($over==$value->over_number  ) {
                                                            if (isset($val->score) &&$val->score != null) {
                                                                $total_runs += $val->score->runs;
                                                                $is_valid=true;
                                                                $count=$count+1;
                                                            }

                                                         }
                                                    }
                                                }

                                                @endphp  
                                                <tr>
                                                    <th scope="row">{{$value->created_at}}</th>
                                                    <td>{{$value->balance}} Rs</td> 
                                                    <td>{{$value->over_number}} </td> 
                                                    <td>@if($value->win_lose==1)You Win @elseif($value->win_lose==2) You Loose @else Result Not Yet  @endif</td> 
                                                    < <td @if($value->win_lose==1) class="text-success" @else class="text-danger" @endif> @if($value->win_amount != null) +{{$value->win_amount}} @else -{{$value->loose_amount}}  @endif</td>

                                                </tr>
                                                @endforeach
                                                @endif
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade {{$top_up_class}}" id="topup" role="tabpanel" aria-labelledby="topup-tab">
                            <div class="row">
                                
                                <div class="col-12">
                                    <h5 class="title">My Match Bets</h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Added On</th>
                                                    <th scope="col">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- {{liveMatch()}} --}}
                                        
                                               @if(isset($topup_history) && $topup_history != null)
                                               @foreach($topup_history as $Key=>$value)
                                                 <tr>
                                                    <th scope="row">{{$value->created_at}}</th>
                                                    <td>{{$value->topup_balance}} Rs</td>
                                                   
                                                </tr>
                                                @endforeach
                                               @endif
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                        <div class="tab-pane fade {{$setting_class}}" id="setting" role="tabpanel"
                            aria-labelledby="setting-tab">
                            <div class="setting-personal-details login-password">
                                <h5>Modify Login Password</h5>
                                <form action="{{route('front.auth.change_password_post')}}" class="FromSubmit" id="change_password">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="single-input">
                                                <label for="loginoldpass">Current Password</label>
                                                <input type="text" name="current_password" id="loginoldpass" placeholder="Enter Current Password">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="single-input">
                                                <label for="loginnewpass">New Password</label>
                                                <input type="text" name="password" id="loginnewpass" placeholder="Enter New Password">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="single-input">
                                                <label for="loginconfirmpass">Confirm Password</label>
                                                <input type="text" name="password_confirmation" id="loginconfirmpass"
                                                    placeholder="Enter Confirm Password">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <span class="btn-border">
                                                <button type="submit" class="cmn-btn">Submit</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
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