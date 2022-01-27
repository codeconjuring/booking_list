@extends('admin.layout._master')


@section('content')

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Book Lists</h4>
                    <div class="page-title-right">
                        <button class="btn btn-primary"><i data-feather="plus"></i> Create Book</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <!-- container-fluid -->

    <div class="ic-dashboard-card">
        <div class="ic-dashboard-card-items box purple">
            <img src="assets/images/purple/purple-1.png" class="first-img" alt="">
            <img src="assets/images/purple/purple-2.png" class="second-img" alt="">
            <img src="assets/images/purple/purlple-3.png" class="third-img" alt="">
            <div class="icon">
                <i class="icon-books"></i>
            </div>
            <div class="ic-card-content">
                <p>Total Series</p>
                <h3>14</h3>
            </div>
        </div>
        <div class="ic-dashboard-card-items box orange">
            <img src="assets/images/purple/purple-1.png" class="first-img" alt="">
            <img src="assets/images/purple/purple-2.png" class="second-img" alt="">
            <img src="assets/images/purple/purlple-3.png" class="third-img" alt="">
            <div class="icon">
                <i class="icon-a-books"></i>
            </div>
            <div class="ic-card-content">
                <p>Total Series</p>
                <h3>14</h3>
            </div>
        </div>
        <div class="ic-dashboard-card-items box blue">
            <img src="assets/images/purple/purple-1.png" class="first-img" alt="">
            <img src="assets/images/purple/purple-2.png" class="second-img" alt="">
            <img src="assets/images/purple/purlple-3.png" class="third-img" alt="">
            <div class="icon">
                <i class="icon-book-open"></i>
            </div>
            <div class="ic-card-content">
                <p>Total Books</p>
                <h3>343</h3>
            </div>
        </div>
        <div class="ic-dashboard-card-items box sky-blue">
            <img src="assets/images/purple/purple-1.png" class="first-img" alt="">
            <img src="assets/images/purple/purple-2.png" class="second-img" alt="">
            <img src="assets/images/purple/purlple-3.png" class="third-img" alt="">
            <div class="icon">
                <i class="icon-book-open"></i>
            </div>
            <div class="ic-card-content">
                <p>Total Language</p>
                <h3>19</h3>
            </div>
        </div>
        <div class="ic-dashboard-card-items box tia">
            <img src="assets/images/purple/purple-1.png" class="first-img" alt="">
            <img src="assets/images/purple/purple-2.png" class="second-img" alt="">
            <img src="assets/images/purple/purlple-3.png" class="third-img" alt="">
            <div class="icon">
                <i class="icon-book-open"></i>
            </div>
            <div class="ic-card-content">
                <p>Total eBook</p>
                <h3>1433</h3>
            </div>
        </div>
        <div class="ic-dashboard-card-items box brown">
            <img src="assets/images/purple/purple-1.png" class="first-img" alt="">
            <img src="assets/images/purple/purple-2.png" class="second-img" alt="">
            <img src="assets/images/purple/purlple-3.png" class="third-img" alt="">
            <div class="icon">
                <i class="icon-book-open"></i>
            </div>
            <div class="ic-card-content">
                <p>Total POD</p>
                <h3>566</h3>
            </div>
        </div>
        <div class="ic-dashboard-card-items box red">
            <img src="assets/images/purple/purple-1.png" class="first-img" alt="">
            <img src="assets/images/purple/purple-2.png" class="second-img" alt="">
            <img src="assets/images/purple/purlple-3.png" class="third-img" alt="">
            <div class="icon">
                <i class="icon-book-open"></i>
            </div>
            <div class="ic-card-content">
                <p>Total Audio</p>
                <h3>668</h3>
            </div>
        </div>
        <div class="ic-dashboard-card-items box sky-blue">
            <img src="assets/images/purple/purple-1.png" class="first-img" alt="">
            <img src="assets/images/purple/purple-2.png" class="second-img" alt="">
            <img src="assets/images/purple/purlple-3.png" class="third-img" alt="">
            <div class="icon">
                <i class="icon-book2"></i>
            </div>
            <div class="ic-card-content">
                <p>Total POD 2</p>
                <h3>987</h3>
            </div>
        </div>
        <div class="ic-dashboard-card-items box">
            <img src="assets/images/purple/purple-1.png" class="first-img" alt="">
            <img src="assets/images/purple/purple-2.png" class="second-img" alt="">
            <img src="assets/images/purple/purlple-3.png" class="third-img" alt="">
            <div class="icon">
                <i class="icon-print"></i>
            </div>
            <div class="ic-card-content">
                <p>Total GFP</p>
                <h3>467</h3>
            </div>
        </div>
    </div>

    <section class="cc-mt-80">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Available Languages and Titles</h4>
                    </div>
                    <div class="card-body pt-0 ps-0 pe-0">
                        <div id="column_chart_datalabel" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Parcent Titles Status per Series</h4>
                    </div>
                    <div class="card-body pt-0 ps-0 pe-0">
                        <div id="bar_chart_datalabel" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cc-mt-80">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div
                            class="cc-table-button-heads align-items-center d-flex justify-content-between ic-pb-20">
                            <h4>Available Languages and Titles</h4>

                            <select name="" id="" class="ic-seclect">
                                <option value="0">Filter by Language</option>
                                <option value="1">Filter by Language</option>
                                <option value="2">Filter by Language</option>
                            </select>
                        </div>
                        <table cellpadding="2" class="cc-datatable table nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">eBook</th>
                                    <th class="text-center">POD1</th>
                                    <th class="text-center">Audio</th>
                                    <th class="text-center">POD2</th>
                                    <th class="text-center">GFP</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                                <tr>
                                    <td class="text-center">EN</td>
                                    <td class="text-center">144</td>
                                    <td>136</td>
                                    <td class="text-center">75</td>
                                    <td class="text-center">20</td>
                                    <td class="text-center">27</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
