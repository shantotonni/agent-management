@extends('layouts.master')
@section('title')
    Meeting View
@endsection
@section('content')

    <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-medium-1-1 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>
        <form action="{!! route('search')!!}" method="post" >
            <div class="uk-grid" data-uk-grid-margin="">
                <div class="uk-width-large-1-4 uk-width-medium-1-1">
                    <div class="">
                       <label for="uk_dp_end">Start Date</label><input class="md-input" name="from_date" id="from_date" data-uk-datepicker="" id="uk_dp_end" type="text">
                    </div>
                    @if($errors->has('from_date'))
                        <span style="color:red">{!!$errors->first('from_date')!!}</span>
                    @endif
                </div>
                {!! csrf_field() !!}
                <div class="uk-width-large-1-4 uk-width-medium-1-1">
                    <div class="">
                       <label for="uk_dp_end">End Date</label> <input class="md-input" name="to_date" id="to_date" data-uk-datepicker="" id="uk_dp_end" type="text">
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

                <div class="uk-width-large-1-4 uk-width-medium-1-1">
                    @if(count($time2)>0)
                        <div class="md-fab md-fab-accent pull-right" style="background-color: #00b0ff">
                            <i class="material-icons"></i><h3 style="color:white">{!! count($time2) !!}</h3>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>


    <br>
    <br>
    <br>

    <?php $pre=''; ?>

    @if(count($time2)>0)

    @foreach($time2 as $time)

    <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-1-1">
            @if($pre!=$time->date)
                <div class="md-card-list-header heading_list" style="color:blue;font-weight: 800"><span>{!! $time->date !!}</span></div>
            @endif
            <ul class="uk-nestable" id="nestable">
                @if($time->prospecit_id>0)
                <li data-id="1" class="uk-nestable-item">
                    <div class="uk-nestable-panel">
                        <div class="md-card-list-item-menu pull-right" data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                            <a href="#" class="md-icon material-icons">&#xE5D4;</a>
                            <div class="uk-dropdown uk-dropdown-small">
                                <ul class="uk-nav">
                                    <li><a href="{!! route('prospect_show',$time->prospecit_id) !!}"><i class="material-icons">&#xE15E;</i>Details</a></li>
                                </ul>
                            </div>
                        </div>
                        <h4 class="pull-right" style="color:lightseagreen;">{!! $time->start_time !!}-{!! $time->end_time !!}</h4>
                        <div style="text-align: center;color: #00A000">
                            <span>{!! $time->prospecit['area'] !!} ,{!! $time->createdBy['name'] !!} ,{!! $time->prospecit['demand'] !!} ,{!! $time->prospecit['pc_1'] !!}</span>

                        </div>

                        <a href="{!! route('prospect_show',$time->prospecit_id) !!}" style="color:green;font-weight: 800">{!! $time->prospecit['client_name'] !!}</a>
                        <br/>
                    </div>
                </li>

                    @else

                    <li data-id="1" class="uk-nestable-item">
                        <div class="uk-nestable-panel">
                            <div class="md-card-list-item-subject" style="text-align: center">
                                <span style="color: red;font-size: 20px;">Time Blocked</span>
                            </div>

                            <span class="md-card-list-item-date pull-right" style="color: red">{!! $time->start_time !!}-{!! $time->end_time !!}</span>

                            <div class="md-card-list-item-sender">
                                <span style="color: #3e1a98;font-weight: 800">{!! $time->createdBy['name'] !!}</span>
                            </div>
                            <br>
                        </div>
                    </li>

                @endif
            </ul>
        </div>
    </div>

    <?php $pre=$time->date; ?>
    @endforeach

    @else
        <div class="uk-alert uk-alert-danger" data-uk-alert>
            <h4 class="heading_b" style="text-align: center">NO Metting View.</h4>

        </div>

        @endif

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

    <script>
        $(function() {
            if(isHighDensity) {
                // enable hires images
                altair_helpers.retina_images();
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
        });
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>
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