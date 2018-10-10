@extends('layouts.master')

@section('title')
     Admin Dashboard
@endsection

@section('content')

    @if(Auth::user()->type==1)
        <div id="page_content_inner">
            <!-- statistics (small charts) -->

            <div class="md-card">
                <div class="uk-width-1-1">
                    <div class="uk-alert uk-alert-large" data-uk-alert>

                        <h4 class="heading_b" style="text-transform: uppercase">Super Admin Dashboard </h4>

                    </div>
                </div>
            </div>
            <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>

                <form class="form-inline" method="post" action="{!! route('super') !!}">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-large-1-4 uk-width-medium-1-1">
                            <div class="">
                                <select data-md-selectize="" id="wizard_birth_place" name="user_id" required>
                                    <option value="all">
                                       All
                                    </option>

                                    {{--<option value="{!! Auth::user()->id !!}">--}}
                                        {{--{!! Auth::user()->name !!}--}}
                                    {{--</option>--}}
                                    @foreach($user as $value)

                                    <option value="{!! $value->id !!}">
                                    {!! $value->name !!}
                                    </option>

                                    @endforeach

                                </select>


                        </div>
                        </div>

                        {!! csrf_field() !!}
                        <div class="uk-input-group uk-width-large-1-4 uk-width-medium-1-1">
                            <div class="">
                                <label for="uk_dp_end">Start Date</label>
                                <input class="md-input" name="from_date" data-uk-datepicker="" id="uk_dp_end" type="text">
                            </div>
                            @if($errors->has('from_date'))
                                <span style="color:red">{!!$errors->first('from_date')!!}</span>
                            @endif
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-1">
                            <div class="">
                               <label for="uk_dp_end">End Date</label>
                                <input class="md-input" name="to_date" data-uk-datepicker="" id="uk_dp_end" type="text">
                            </div>
                            @if($errors->has('to_date'))
                                <span style="color:red">{!!$errors->first('to_date')!!}</span>
                            @endif
                        </div>
                        <div class="uk-width-large-1-4 uk-width-medium-1-1">
                            <div class="uk-width-medium-1-6">
                                <button class="md-btn" type="submit" data-uk-button>Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-5 uk-text-center uk-sortable sortable-handler" id="dashboard_sortable_cards" data-uk-sortable data-uk-grid-margin>
                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                @if(count($superadmin)>0)
                                <h1>{!! count($superadmin) !!}</h1>
                                    @else
                                    <h3>Empty</h3>
                                @endif
                            </div>
                        </div>
                        <div class="md-card-overlay-content" style="background: #02A8F3;color: white;font-weight: bold;">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                   Total Prospect
                                </h3>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias consectetur.
                        </div>
                    </div>
                </div>


                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">

                                <h1>{!! $total !!}</h1>

                            </div>
                        </div>
                        <div class="md-card-overlay-content" style="background: #D62728;color: white;font-weight: bold;">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Total Meeting
                                </h3>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias consectetur.
                        </div>
                    </div>
                </div>

                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">

                            @if(count($phase)>0)
                            <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                <h1>
                                    {!! count($phase) !!}
                                </h1>
                            </div>
                            @else

                                <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                    <h3>Empty</h3>
                                </div>

                                @endif

                        </div>
                        <div class="md-card-overlay-content" style="background: #FFA000;color: white;font-weight: bold;">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Total customer
                                </h3>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias consectetur.
                        </div>
                    </div>
                </div>

                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                @if(count($complit)>0)
                                <h1>{!! count($complit) !!}</h1>
                                    @else
                                    <h3>Empty</h3>
                                @endif
                            </div>
                        </div>
                        <div class="md-card-overlay-content" style="background: #7CB342;color: white;font-weight: bold;">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Total Completed Meeting
                                </h3>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias consectetur.
                        </div>
                    </div>
                </div>

                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                @if(count($time)>0)
                                <h1>{!! count($time) !!}</h1>
                                @else
                                    <h3>Empty</h3>
                                @endif
                            </div>
                        </div>
                        <div class="md-card-overlay-content" style="background: #009385;color: white;font-weight: bold;">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Total Pending Meeting
                                </h3>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias consectetur.
                        </div>
                    </div>
                </div>

            </div>

            </div>

        @else

    <!-- secondary sidebar end -->



        <div id="page_content_inner">
            <!-- statistics (small charts) -->
            <div class="md-card">
                <div class="uk-width-1-1">
                    <div class="uk-alert uk-alert-large" data-uk-alert>

                        <h4 class="heading_b" style="text-transform: uppercase">Agent Dashboard </h4>

                    </div>
                </div>
            </div>
            <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>

                <form class="form-inline" method="post" action="{!! route('agentsearch') !!}">
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-width-large-1-4 uk-width-medium-1-1">
                            <div class="uk-input-group">
                                <label for="uk_dp_end">Start Date</label>
                                <input class="md-input" name="from_date" data-uk-datepicker="" id="uk_dp_end" type="text">
                            </div>
                            @if($errors->has('from_date'))
                                <span style="color:red">{!!$errors->first('from_date')!!}</span>
                            @endif
                        </div>


                        {!! csrf_field() !!}
                        <div class="uk-width-large-1-4 uk-width-medium-1-1">
                            <div class="uk-input-group">
                                <label for="uk_dp_end">End Date</label>
                                <input class="md-input" name="to_date" data-uk-datepicker="" id="uk_dp_end" type="text">
                            </div>
                            @if($errors->has('to_date'))
                                <span style="color:red">{!!$errors->first('to_date')!!}</span>
                            @endif
                        </div>



                        <div class="uk-width-large-1-4 uk-width-medium-1-1">
                            <div class="uk-width-medium-1-6">
                                <button class="md-btn" type="submit" data-uk-button>Filter</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>


            <div class="uk-grid uk-grid-width-small-1-2 uk-grid-width-large-1-3 uk-grid-width-xlarge-1-5 uk-text-center uk-sortable sortable-handler" id="dashboard_sortable_cards" data-uk-sortable data-uk-grid-margin>
                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">

                                @if(count($superadmin)>0)
                                <h1>{!! count($superadmin) !!}</h1>
                                    @else
                                <h3>Empty</h3>
                                @endif
                            </div>
                        </div>
                        <div class="md-card-overlay-content" style="background: #02A8F3;color: white;font-weight: bold;">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Total Prospecit
                                </h3>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias consectetur.
                        </div>
                    </div>
                </div>

                @php
                    $t=count($time);
                    $c=count($complit);
                    $total=$t+$c;
                @endphp
                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                @if(count($total)>0)
                                    <h1>{!! count($total) !!}</h1>
                                @else
                                    <h3>Empty</h3>
                                @endif
                            </div>
                        </div>
                        <div class="md-card-overlay-content" style="background: #D62728;color: white;font-weight: bold;">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Total Meeting
                                </h3>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias consectetur.
                        </div>
                    </div>
                </div>

                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">

                            <div class="md-card-content">
                                    <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                        @if(count($phase)>0)
                                        <h1>{!! count($phase) !!}</h1>
                                        @else
                                            <h3>Empty</h3>
                                        @endif
                                    </div>
                            </div>


                        </div>
                        <div class="md-card-overlay-content" style="background: #FFA000;color: white;font-weight: bold;">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Total customer
                                </h3>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias consectetur.
                        </div>
                    </div>
                </div>

                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                @if(count($complit)>0)
                                <h1>{!! count($complit) !!}</h1>
                                    @else
                                <h3>Empty</h3>
                                @endif
                            </div>
                        </div>
                        <div class="md-card-overlay-content" style="background: #7CB342;color: white;font-weight: bold;">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Total Completed Meeting
                                </h3>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias consectetur.
                        </div>
                    </div>
                </div>

                <div>
                    <div class="md-card md-card-hover md-card-overlay">
                        <div class="md-card-content">
                            <div class="epc_chart" data-percent="76" data-bar-color="#03a9f4">
                                @if(count($time)>0)
                                <h1>{!! count($time) !!}</h1>
                                    @else
                                    <h3>Empty</h3>
                                @endif
                            </div>
                        </div>
                        <div class="md-card-overlay-content" style="background: #009385;color: white;font-weight: bold;">
                            <div class="uk-clearfix md-card-overlay-header">
                                <i class="md-icon material-icons md-card-overlay-toggler">&#xE5D4;</i>
                                <h3>
                                    Total Pending Meeting
                                </h3>
                            </div>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus alias consectetur.
                        </div>
                    </div>
                </div>

            </div>

        </div>

    @endif

    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    @endsection