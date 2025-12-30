@extends('admin.partical.main')
@push('title')
<title>Dashboard | Admin</title>
@endpush

@push('custom-css')

@endpush

@section('content')

        <div class="main-content">
            <div class="pages-content">
                <div class="dash-tabs d-flex justify-content-between align-items-center mb-3">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item me-3">
                            <button class="client-main-btn" type="button" >Employee <img src="{{ asset('public/admin/assets/images/icons/double-arrow.png')}}" alt=""> </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill" id="pills-Allclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Allclient" type="button" role="tab" aria-controls="pills-Allclient" aria-selected="true">All </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-Activeclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Activeclient" type="button" role="tab" aria-controls="pills-Activeclient" aria-selected="false">Active </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-InActiveclient-tab" data-bs-toggle="pill" data-bs-target="#pills-InActiveclient" type="button" role="tab" aria-controls="pills-InActiveclient" aria-selected="false">Inactive </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-Completedclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Completedclient" type="button" role="tab" aria-controls="pills-Completedclient" aria-selected="false">Completed </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-Dropedclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Dropedclient" type="button" role="tab" aria-controls="pills-Dropedclient" aria-selected="false">Droped </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-Editclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Editclient" type="button" role="tab" aria-controls="pills-Editclient" aria-selected="false">Edit </button>
                        </li>
                    </ul>

                    <div class="dash-tabs-filter d-flex gap-3">
                        <div class="filter-btn">
                            <a href="#!" class="d-flex align-items-center gap-2"  data-bs-toggle="modal" data-bs-target="#filterModel"> <img src="{{ asset('public/admin/assets/images/icons/setting.png')}}" alt="">Filter</a>
                        </div>
                        <div class="create-client-btn">
                            <a href="{{  route('admin.employee.create')}}" class="d-flex align-items-center gap-2"> <img src="{{ asset('public/admin/assets/images/icons/plus.png')}}" alt="">Create Employee</a>
                        </div>
                    </div>
                </div>

                <div class="dash-tabs-content no-scrollbar">
                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-Allclient" role="tabpanel" aria-labelledby="pills-Allclient-tab" tabindex="0">

                            <div class="table-responsive">
                                <table  class="table example">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                    All
                                                </div>

                                            </th>
                                            <th>SNo.</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Designation</th>
                                            <th>Client Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($employees as $key=>$allemployees)

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $allemployees->rand_id }}</td>
                                            <td>{{ $allemployees->name ?? '---' }}</td>
                                            <td>{{ $allemployees->email }}</td>
                                            <td>{{ $allemployees->mobile_no }}</td>
                                            <td>{{ $allemployees->getDesignationName->destination ?? '---' }}</td>
                                            <td>{{ $allemployees->getClientName->name ?? '---' }}</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li>
                                                        <span
                                                            class="iconify delete-icon"
                                                            data-icon="iconoir:trash"
                                                            data-inline="false"
                                                            style="font-size: 24px; cursor: pointer;"
                                                            data-id="{{ $allemployees->id }}">
                                                        </span>
                                                    </li>
                                                    <a href="{{ route('admin.employee.detail',['id'=>$allemployees->id])}}"><li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li></a>
                                                </ul>
                                            </td>
                                        </tr>


                                        @empty

                                        @endforelse






                                        <!-- Add more rows here -->
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="pills-Activeclient" role="tabpanel" aria-labelledby="pills-Activeclient-tab" tabindex="0">
                            <div class="table-responsive">
                                <table  class="table example">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                    All
                                                </div>

                                            </th>
                                            <th>SNo.</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Designation</th>
                                            <th>Client Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Sample Rows -->
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>#4651</td>
                                            <td>1</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>





                                        <!-- Add more rows here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-InActiveclient" role="tabpanel" aria-labelledby="pills-InActiveclient-tab" tabindex="0">
                            <div class="table-responsive">
                                <table  class="table example">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                    All
                                                </div>

                                            </th>
                                            <th>SNo.</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Designation</th>
                                            <th>Client Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Sample Rows -->
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>#4651</td>
                                            <td>1</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>





                                        <!-- Add more rows here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Completedclient" role="tabpanel" aria-labelledby="pills-Completedclient-tab" tabindex="0">
                            <div class="table-responsive">
                                <table  class="table example">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                    All
                                                </div>

                                            </th>
                                            <th>SNo.</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Designation</th>
                                            <th>Client Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Sample Rows -->
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>#4651</td>
                                            <td>1</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>





                                        <!-- Add more rows here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Dropedclient" role="tabpanel" aria-labelledby="pills-Dropedclient-tab" tabindex="0">
                        <div class="table-responsive">
                        <table  class="table example">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                    All
                                                </div>

                                            </th>
                                            <th>SNo.</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Designation</th>
                                            <th>Client Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Sample Rows -->
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>#4651</td>
                                            <td>1</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>#4651</td>
                                            <td>Manish</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Hop Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>#4651</td>
                                            <td>Anher Gardner</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>786535678</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>
                                                <ul class="action-icons d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="basil:eye-outline" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>





                                        <!-- Add more rows here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-Editclient" role="tabpanel" aria-labelledby="pills-Editclient-tab" tabindex="0">
                        <div class="table-responsive">
                                <table  class="table example">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                    All
                                                </div>

                                            </th>
                                            <th>SNo.</th>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Designation</th>
                                            <th>Client Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Sample Rows -->
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>Hop Gardner</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>786535678</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aliquid iusto accusa</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>Anher Gardner</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>786535678</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aliquid iusto accusa</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>Manish</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>786535678</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>Aliquid iusto accus</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>Hop Gardner</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>786535678</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aliquid iusto accus</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>Anher Gardner</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>786535678</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aliquid iusto accusa</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>Manish</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>786535678</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>Aliquid iusto accus</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>Hop Gardner</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>786535678</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aliquid iusto accus</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>Anher Gardner</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>786535678</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aliquid iusto accusa</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>Manish</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>786535678</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>Aliquid iusto accus</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>Hop Gardner</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>786535678</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aliquid iusto accus</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>Anher Gardner</td>
                                            <td>Aem magnam voluptas</td>
                                            <td>786535678</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aliquid iusto accusa</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>1</td>
                                            <td>Manish</td>
                                            <td>Sit pariatur Labor</td>
                                            <td>786535678</td>
                                            <td>wajuqu@mailinator.com</td>
                                            <td>Brady and Cooley Co</td>
                                            <td>Aliquid iusto accus</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>Hop Gardner</td>
                                            <td>Rem magnam voluptas</td>
                                            <td>786535678</td>
                                            <td>kytaju@mailinator.com</td>
                                            <td>Rivers and Sandoval Co</td>
                                            <td>Aliquid iusto accus</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="uil:pen" data-inline="false" style="font-size: 24px;"></span>
                                                    </i></li>
                                                </ul>
                                            </td>
                                        </tr>


                                        <!-- Add more rows here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>




          <!-- write-body-content here end -->
        </div>

      </div>
    </section>

    <div class="search-box-mob">
      <div class="close-search-bar">
        <img
          width="30"
          height="30"
          src="https://img.icons8.com/ios/30/close-window.png')}}"
          alt="close-window"
        />
      </div>




      @push('custom-js')


      @endpush
      @endsection
