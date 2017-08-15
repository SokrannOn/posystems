<li>
                            <a href="{{route('dashbords.index') }}"><i class="fa fa-bell fa-fw"></i> Notifications</a>
</li>
 <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#Account"><i class="fa fa-shopping-basket" aria-hidden="true"></i> All Purchase Orders<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="Account" class="collapse nav nav-second-level">
                                <li>
                                    <a href="{{ route('invoicePO.index')}}">New Invoice</a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#summa"><i class="fa fa-list-alt" aria-hidden="true"></i> Summary Invoices <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="summa" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('summaryInvs.index')}}">All Summary Invocie</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('summaryInvs.create')}}">Create Summary Invocie</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>