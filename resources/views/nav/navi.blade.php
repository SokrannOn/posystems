
                        <li>
                            <a href="{{route('dashbords.index') }}"><i class="fa fa-bell fa-fw"></i> Notifications</a>
                        </li>
                        <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Admin"><i class="fa fa-fw  fa-wrench"></i> Administrator <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="Admin" class="collapse nav nav-second-level">
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Positions"><i class="fa fa-fw fa-briefcase"></i> Positions <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Positions" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('positions.index')}}">All Positions</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('positions.create')}}">Create New Position</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Brands"><i class="fa fa-fw fa-briefcase"></i> Brands <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Brands" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('brands.index')}}">All Brands</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('brands.create')}}">Create New Brand</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Users"><i class="fa fa-fw fa-user"></i> User <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Users" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('users.index')}}">All Users</a>
                                        </li>
                                        <li>
                                            <a href="{{route('users.create')}}">Create New User</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Categories"><i class="fa fa-tags" aria-hidden="true"></i> Categories <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Categories" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('categories.index')}}">All Categories</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('categories.create')}}">Create New Categories</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Products"><i class="fa fa-product-hunt" aria-hidden="true"></i></i> Products <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Products" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('products.index')}}">All Products</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('products.create')}}">Create New Products</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Channels"><i class="fa fa-area-chart" aria-hidden="true"></i> Channels <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Channels" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('channels.index')}}">All Channels</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('channels.create')}}">Create New Channels</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Zones"><i class="fa fa-map-marker" aria-hidden="true"></i> Zones <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Zones" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('zones.index')}}">All Zones</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('zones.create')}}">Create New Zones</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#SetValues"><i class="fa fa-fw f fa-money"></i> SetValue <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="SetValues" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('setValues.index')}}">All Values</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Supp"><i class="fa fa-building-o" aria-hidden="true"></i> Suppliers <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Supp" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('suppliers.index')}}">All Suppliers</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('suppliers.create')}}">Create New Suppliers</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#pricelist"><i class="fa fa-money" aria-hidden="true"></i> Price List <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="pricelist" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('pricelists.index')}}">All Price List</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('pricelists.create')}}">Create New Price List</a>
                                        </li>
                                    </ul>
                                </li>
                              </li>
                            </ul>
                        </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Address"><i class="fa fa-fw  fa-bank"></i> Address <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="Address" class="collapse nav nav-second-level">
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Provinces"><i class="fa fa-fw fa-home"></i> Province <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Provinces" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('provinces.index')}}">All Province</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('provinces.create')}}">Create New Province</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Districts"><i class="fa fa-fw fa-home"></i> District <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Districts" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('districts.index')}}">All District</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('districts.create')}}">Create New District</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Communes"><i class="fa fa-fw fa-home"></i> Commune <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Communes" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('communes.index')}}">All Communes</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('communes.create')}}">Create New Commune</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Villages"><i class="fa fa-fw fa-home"></i> Village <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Villages" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('villages.index')}}">All Villages</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('villages.create')}}">Create New Villages</a>
                                        </li>
                                    </ul>
                                </li>
                              </li>
                            </ul>
                        </li>
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
                            <a href="javascript:;" data-toggle="collapse" data-target="#PurchaseOrder"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Purchase Order Sale<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="PurchaseOrder" class="collapse nav nav-second-level">
                                <li>
                                    <a href="{{ route('purchaseOrders.index')}}">All Purchase Order</a>
                                </li>
                                <li>
                                    <a href="{{ route('purchaseOrders.create')}}">Create New Order</a>
                                </li>
                                <li>
                                    <a href="{{ route('verifys.create')}}">Verify Purchase Order</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#PurchaseOrderSD"><i class="fa fa-shopping-basket" aria-hidden="true"></i></i> Purchase Order SD<i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="PurchaseOrderSD" class="collapse nav nav-second-level">
                                <li>
                                    <a href="{{ route('purchaseOrdersSD.index')}}">All Purchase Order</a>
                                </li>
                                <li>
                                    <a href="{{ route('purchaseOrdersSD.create')}}">Create New Order</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="collapse" data-target="#Account"><i class="fa fa-money" aria-hidden="true"></i> Account Managment<i class="fa fa-fw fa-caret-down"></i></a>
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
                        <li><a href="javascript:;" data-toggle="collapse" data-target="#Stock"><i class="fa fa-industry" aria-hidden="true"></i> Stock Management <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="Stock" class="collapse nav nav-second-level">

                               {{--stock_in_menu --}}
                                <li><a href="javascript:;" data-toggle="collapse" data-target="#stockin"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Stock In <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="stockin" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{URL::to('/admin/stock')}}">Add New</a>
                                        </li>
                                        <li>
                                            <a href="{{route('stock.index')}}">Views</a>
                                        </li>
                                    </ul>
                                </li>

                                {{--end stock-in-menu--}}


                                {{--stock_out_menu --}}
                                <li><a href="javascript:;" data-toggle="collapse" data-target="#stockout"><i class="fa fa-truck" aria-hidden="true"></i> Stock Out <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="stockout" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{route('stockout.create')}}">Export</a>
                                        </li>
                                        <li>
                                            <a href="{{route('stockout.index')}}">Views</a>
                                        </li>
                                    </ul>
                                </li>

                                {{--end stock-out-menu--}}


                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#cat"><i class="fa fa-tags" aria-hidden="true"></i> Category <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="cat" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('categories.index')}}">All Categories</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('categories.create')}}">Create New Category</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#Pro"><i class="fa fa-product-hunt" aria-hidden="true"></i> Product <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="Pro" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('products.index')}}">All Products</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('products.create')}}">Create New Product</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:;" data-toggle="collapse" data-target="#stock"><i class="fa fa-files-o" aria-hidden="true"></i> All Invoices <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="stock" class="collapse nav nav-second-level">
                                        <li>
                                            <a href="{{ route('stocks.index')}}">Update Delivery</a>
                                        </li>
                                    </ul>
                                </li>
                              </li>
                            </ul>
                        </li>