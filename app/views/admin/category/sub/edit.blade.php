@extends('admin.layout')

@section('breadcrumb')
<div class="row">
    <div class="col-md-12">
        <h3 class="page-title">{{ $langLbl['Sub Category Management'] }}</h3>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <span>{{ $langLbl['Sub Category'] }}</span>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>{{ $langLbl['Edit'] }}</span>
            </li>
        </ul>

    </div>
</div>    
@stop

@section('content')

@if ($errors->has())
<div class="alert alert-danger alert-dismissibl fade in">
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">{{ $langLbl['Close'] }}</span>
    </button>
    @foreach ($errors->all() as $error)
    {{ $error }}		
    @endforeach
</div>
@endif

<div class="portlet box blue">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-pencil-square-o"></i> {{ $langLbl['Edit Sub Category'] }}
        </div>
    </div>
    <div class="portlet-body form">
        <form class="form-horizontal form-bordered form-row-stripped" role="form" method="post" action="{{ URL::route('admin.sub.category.store') }}">
            <div class="form-body">
                <input type="hidden" name="sub_category_id" value="{{ $subCategory->id }}">
                <input type="hidden" name="category_id" value="{{ $subCategory->category_id }}"/>  
                 @if($siteLanguage)
                @foreach ($siteLanguage as $lkey=>$rvalue)
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ Form::label('name'.$rvalue, $langLbl['Name'].' ('.$langLbl[$lkey].')') }}</label>
                    <div class="col-sm-9">
                        {{ Form::text('name'.$rvalue,  $subCategory->{'name'.$rvalue}, ['class' => 'form-control']) }}
                    </div>
                </div>	
                @endforeach
                @endif            
                @if($siteLanguage)
                @foreach ($siteLanguage as $lkey=>$rvalue)
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ Form::label('description'.$rvalue, $langLbl['Description'].' ('.$langLbl[$lkey].')') }}</label>
                    <div class="col-sm-9">
                        {{ Form::text('description'.$rvalue, $subCategory->{'description'.$rvalue}, ['class' => 'form-control']) }}
                    </div>
                </div>	
                @endforeach
                @endif   
                @foreach ([
                'icon' => 'Icon',
                'created_at' => 'Created At',
                'updated_at' => 'Updated At',                    
                ] as $key => $value)
                @if ($key === 'created_at' || $key === 'updated_at')
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ Form::label($key, $value) }}</label>
                    <div class="col-sm-9">
                        <p class="form-control-static">{{ $subCategory->{$key} }} </p>
                    </div>
                </div>
                @elseif ($key == 'description')
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ Form::label($key, $value) }}</label>
                    <div class="col-sm-9">
                        {{ Form::textarea($key, $subCategory->{$key}, ['class' => 'form-control']) }}
                    </div>
                </div>
                @elseif ($key == 'icon')
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ Form::label($key, $value) }}</label>
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control" name="{{ $key }}" id="js-hidden-{{ $key }}" value="{{ $subCategory->icon }}">
                        <a class="btn btn-default" data-toggle="modal" href="#js-modal-icon" id="js-a-{{ $key }}">
                            <i class="{{ $subCategory->icon }}"></i> 
                        </a>
                        <span class="color-gray-normal"><i>&nbsp;&nbsp;&nbsp;( {{ $langLbl['Click the button to change the Icon'] }} )</i></span>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{ Form::label($key, $value) }}</label>
                    <div class="col-sm-9">
                        {{ Form::text($key, $subCategory->{$key}, ['class' => 'form-control']) }}
                    </div>
                </div>
                @endif                
                @endforeach
            </div>
            <div class="form-actions fluid">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-success">
                        <span class="glyphicon glyphicon-ok-circle"></span> {{ $langLbl['Save'] }}
                    </button>
                    <a href="{{ URL::route('admin.category.edit', $subCategory->category_id) }}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-share-alt"></span> {{ $langLbl['Back'] }}
                    </a>
                </div>
            </div>            
        </form>
    </div>
</div>

<div class="modal fade bs-modal-lg" id="js-modal-icon" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{ $langLbl['Please select the Icon'] }}</h4>
            </div>
            <div class="modal-body">
                @foreach ($icons as $key => $value)
                <button class="btn btn-default" style="margin-top: 1px;" id="js-btn-icon"><i class="{{ $value }}"></i></button>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ $langLbl['Close'] }}</button>
                <button type="button" class="btn blue" id="js-btn-select" data-dismiss="modal">{{ $langLbl['Select'] }}</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('custom-scripts')
<script>
    $(document).ready(function() {
        $("button#js-btn-icon").click(function() {
            $("button#js-btn-icon").removeClass("red");
            $("button#js-btn-icon").addClass("btn-default");
            $(this).addClass('red');
            $(this).removeClass('btn-default');
        });
        $("button#js-btn-select").click(function() {
            if ($("button#js-btn-icon.red").size() > 0) {
                var icon = $("button#js-btn-icon.red").find("i").attr('class');
                $("#js-hidden-icon").val(icon);
                $("#js-a-icon").find("i").attr('class', icon);
                $("#js-modal-icon").modal('toggle');
            } else {
                bootbox.alert('{{ $langLbl["Please select the Icon"] }}');
            }
        });

    });
</script>
@stop

@stop
