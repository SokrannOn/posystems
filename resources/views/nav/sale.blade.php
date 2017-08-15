<li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#Customers"><i class="fa fa-fw fa-group"></i> Customer <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="Customers" class="collapse nav nav-second-level">
                                <li>
                                    <a href="{{ route('customers.index')}}">All Customers</a>
                                </li>
                                <li>
                                    <a href="{{ route('customers.create')}}">Create New Customer</a>
                                </li>
                            </ul>
</li>
<li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#PurchaseOrder"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Purchase Order<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="PurchaseOrder" class="collapse nav nav-second-level">
                                <li>
                                    <a href="{{ route('purchaseOrders.index')}}">All Purchase Order</a>
                                </li>
                                <li>
                                    <a href="{{ route('purchaseOrders.create')}}">Create New Order</a>
                                </li>
                            </ul>
</li>