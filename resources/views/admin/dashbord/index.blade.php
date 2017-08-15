@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-12">                
        <h3 class="page-header"><i class="fa fa-bell" aria-hidden="true"></i> Notifications</h3>
    </div>
                <!-- /.col-lg-12 -->
</div>
@if(Auth::user()->position->name != 'Accountant')
@if(Auth::user()->position->name != 'Stock')
<div class="row">
    <div class="col-lg-4 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>                            
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$countpocus}}</div>
                            <div>New Orders Customer !</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('invoicePO.index')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$countposd}}</div>
                           <div>New Orders SD !</div>                                
                        </div>
                    </div>
                </div>
                <a href="{{ route('invoicePO.index')}}">                    
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">                            
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-envelope fa-5x" aria-hidden="true"></i>
                        </div>
                        <div class="col-xs-9 text-right">                                    
                            <div class="huge">{{$countinvoices}}</div>
                            <div>Created Invoices !</div>
                        </div>                        
                    </div>
                </div>
                <a href="{{ route('stocks.index')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>                         
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                </div>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-truck fa-5x" aria-hidden="true"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$countexported}}</div>
                            <div>Exported !</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('stocks.index')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    <div class="col-lg-4 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x" aria-hidden="true"></i>                            
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$countpaid}}</div>
                            <div>Invoice Paid !</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('admin/showpaid',1)}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    <div class="col-lg-4 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-credit-card fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$countunpaid}}</div>
                           <div>Invoice Unpaid !</div>                                
                        </div>
                    </div>
                </div>
                <a href="{{ url('admin/showpaid',0)}}">                    
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                </div>
                </a>
            </div>
        </div>
    </div>
    @endif
    @endif
    {{----------------------------------------startAccount--------------}}
    @if(Auth::user()->position->name == 'Accountant')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>                            
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$countpocus}}</div>
                            <div>New Orders Customer !</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('invoicePO.index')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$countposd}}</div>
                           <div>New Orders SD !</div>                                
                        </div>
                    </div>
                </div>
                <a href="{{ route('invoicePO.index')}}">                    
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                </div>
                </a>
            </div>
        </div>
    <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-money fa-5x" aria-hidden="true"></i>                            
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$countpaid}}</div>
                            <div>Invoice Paid !</div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('admin/showpaid',1)}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-credit-card fa-5x" aria-hidden="true"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge">{{$countunpaid}}</div>
                           <div>Invoice Unpaid !</div>                                
                        </div>
                    </div>
                </div>
                <a href="{{ url('admin/showpaid',0)}}">                    
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                </div>
                </a>
            </div>
        </div>
    </div>
    @endif
    {{------------------------------endAccount----------}}
    @if(Auth::user()->position->name == 'Stock')
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">                            
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-envelope fa-5x" aria-hidden="true"></i>
                        </div>
                        <div class="col-xs-9 text-right">                                    
                            <div class="huge">{{$countinvoices}}</div>
                            <div>Created Invoices !</div>
                        </div>                        
                    </div>
                </div>
                <a href="{{ route('stocks.index')}}">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>                         
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                </div>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-truck fa-5x" aria-hidden="true"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$countexported}}</div>
                            <div>Exported !</div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('stocks.index')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endif
    {{-------------------------------------------endstock------------}}
@endsection