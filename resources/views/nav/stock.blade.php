<li>
                            <a href="{{route('dashbords.index') }}"><i class="fa fa-bell fa-fw"></i> Notifications</a>
</li>
<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#Stock"><i class="fa fa-industry" aria-hidden="true"></i> Stock Management <i class="fa fa-fw fa-caret-down"></i></a>
                            <ul id="Stock" class="collapse nav nav-second-level">
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
                                    <a href="javascript:;" data-toggle="collapse" data-target="#stock"><i class="fa fa-files-o" aria-hidden="true"></i> Invoice <i class="fa fa-fw fa-caret-down"></i></a>
                                    <ul id="stock" class="collapse nav nav-second-level">
                                    <li>
                                            <a href="{{ route('stocks.index')}}">Update Delivery</a>
                                        </li>
                                    </ul>
                                </li>