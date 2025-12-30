<?php include '../partials/header.php';?>

        <div class="main-content">
          <!-- write-body-content here start -->
            <div class="pages-content">
                <div class="dash-tabs d-flex justify-content-between align-items-center mb-3">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <!-- <li class="nav-item me-3">
                            <button class="client-main-btn" type="button" >Employee <img src="../assets/images/icons/double-arrow.png" alt=""> </button>
                        </li> -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill" id="pills-Allclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Allclient" type="button" role="tab" aria-controls="pills-Allclient" aria-selected="true">Roles </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-Activeclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Activeclient" type="button" role="tab" aria-controls="pills-Activeclient" aria-selected="false">Time Sheet </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-InActiveclient-tab" data-bs-toggle="pill" data-bs-target="#pills-InActiveclient" type="button" role="tab" aria-controls="pills-InActiveclient" aria-selected="false">Tasks Update </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill" id="pills-Completedclient-tab" data-bs-toggle="pill" data-bs-target="#pills-Completedclient" type="button" role="tab" aria-controls="pills-Completedclient" aria-selected="false">Warring </button>
                        </li>
                       
                    </ul>

                    <div class="dash-tabs-filter     d-flex gap-3">
                       
                        <div class="create-client-btn">
                            <a href="add-employee.php" class="d-flex align-items-center gap-2"> <img src="../assets/images/icons/plus.png" alt="">Add Roles and Responsibility </a>
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
                                            <th>Roles and Responsibility </th>
                                            <th>Status</th>
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
                                            <td>This includes prioritizing tasks, managing time efficiently, and meeting deadlines.</td>
                                            <td>
                                                <span class="badge succes-bg">Accepted</span>
                                                <span class="badge danger-bg">Declined</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">               
                                                </div>
                                            </td>
                                            <td>2</td>
                                            <td>Employees can collaborate more effectively with colleagues when they know their roles. </td>
                                            <td>
                                                <span class="badge succes-bg">Accepted</span>
                                                <span class="badge danger-bg">Declined</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">               
                                                </div>
                                            </td>
                                            <td>3</td>
                                            <td>Office manager duties and responsibilities include scheduling meetings and appointments, greeting visitors and providing</td>
                                            <td>
                                                <span class="badge succes-bg">Accepted</span>
                                                <span class="badge danger-bg">Declined</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">               
                                                </div>
                                            </td>
                                            <td>4</td>
                                            <td>Common tasks include answering phones, office management, ordering supplies, and arranging meetings and travel schedules. </td>
                                            <td>
                                                <span class="badge succes-bg">Accepted</span>
                                                <span class="badge danger-bg">Declined</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">               
                                                </div>
                                            </td>
                                            <td>5</td>
                                            <td>Cooperate with their employer with regard to safety, health and welfare at work.</td>
                                            <td>
                                                <span class="badge succes-bg">Accepted</span>
                                                <span class="badge danger-bg">Declined</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">               
                                                </div>
                                            </td>
                                            <td>6</td>
                                            <td>Administrative Support: Providing vital assistance to higher-level staff by managing calendars, appointments, and correspondence.</td>
                                            <td>
                                                <span class="badge succes-bg">Accepted</span>
                                                <span class="badge danger-bg">Declined</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">               
                                                </div>
                                            </td>
                                            <td>7</td>
                                            <td>This includes prioritizing tasks, managing time efficiently, and meeting deadlines.</td>
                                            <td>
                                                <span class="badge succes-bg">Accepted</span>
                                                <span class="badge danger-bg">Declined</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">               
                                                </div>
                                            </td>
                                            <td>8</td>
                                            <td>This includes prioritizing tasks, managing time efficiently, and meeting deadlines.</td>
                                            <td>
                                                <span class="badge succes-bg">Accepted</span>
                                                <span class="badge danger-bg">Declined</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="">               
                                                </div>
                                            </td>
                                            <td>9</td>
                                            <td>This includes prioritizing tasks, managing time efficiently, and meeting deadlines.</td>
                                            <td>
                                                <span class="badge succes-bg">Accepted</span>
                                                <span class="badge danger-bg">Declined</span>
                                            </td>
                                        </tr>
                                        

                                        <!-- Add more rows here -->
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="pills-Activeclient" role="tabpanel" aria-labelledby="pills-Activeclient-tab" tabindex="0">
                            <div class="table-responsive ">
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
                                            <th>Emp ID</th>
                                            <th>Employee Name</th>
                                            <th>Email</th>
                                            <th>Date</th>
                                            <th>Project </th>
                                            <th>Assigned Hours</th>
                                            <th>Worked Hours</th>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>#EMP609     </td>
                                            <td>Kimberley Myers</td>
                                            <td>wajuquq@mailinator.com</td>
                                            <td>14 Jan 2024</td>
                                            <td>Office Management</td>
                                            <td>32</td>
                                            <td>13</td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <th>Task Name</th>
                                            <th>Project Name</th>
                                            <th>Created Date</th>
                                            <th>Due Date</th>
                                            <th>Priority</th>
                                            <th>Status</th>
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
                                            <td>Payment Gateway</td>
                                            <td>Educational Platform</td>
                                            <td>Moksh@Bidding24×7.Com</td>
                                            <td>14 Jan 2024</td>
                                            <td>14 Dec 2024</td>
                                            <td><span class="badge  succes-bg ">Good</span></td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>Payment Gateway</td>
                                            <td>Educational Platform</td>
                                            <td>Moksh@Bidding24×7.Com</td>
                                            <td>14 Jan 2024</td>
                                            <td>14 Dec 2024</td>
                                            <td><span class="badge  succes-bg ">Good</span></td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>Payment Gateway</td>
                                            <td>Educational Platform</td>
                                            <td>Moksh@Bidding24×7.Com</td>
                                            <td>14 Jan 2024</td>
                                            <td>14 Dec 2024</td>
                                            <td><span class="badge  succes-bg ">Good</span></td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>Payment Gateway</td>
                                            <td>Educational Platform</td>
                                            <td>Moksh@Bidding24×7.Com</td>
                                            <td>14 Jan 2024</td>
                                            <td>14 Dec 2024</td>
                                            <td><span class="badge  succes-bg ">Good</span></td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>Payment Gateway</td>
                                            <td>Educational Platform</td>
                                            <td>Moksh@Bidding24×7.Com</td>
                                            <td>14 Jan 2024</td>
                                            <td>14 Dec 2024</td>
                                            <td><span class="badge  succes-bg ">Good</span></td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>Payment Gateway</td>
                                            <td>Educational Platform</td>
                                            <td>Moksh@Bidding24×7.Com</td>
                                            <td>14 Jan 2024</td>
                                            <td>14 Dec 2024</td>
                                            <td><span class="badge  succes-bg ">Good</span></td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>Payment Gateway</td>
                                            <td>Educational Platform</td>
                                            <td>Moksh@Bidding24×7.Com</td>
                                            <td>14 Jan 2024</td>
                                            <td>14 Dec 2024</td>
                                            <td><span class="badge  succes-bg ">Good</span></td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>Payment Gateway</td>
                                            <td>Educational Platform</td>
                                            <td>Moksh@Bidding24×7.Com</td>
                                            <td>14 Jan 2024</td>
                                            <td>14 Dec 2024</td>
                                            <td><span class="badge  succes-bg ">Good</span></td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>Payment Gateway</td>
                                            <td>Educational Platform</td>
                                            <td>Moksh@Bidding24×7.Com</td>
                                            <td>14 Jan 2024</td>
                                            <td>14 Dec 2024</td>
                                            <td><span class="badge  succes-bg ">Good</span></td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>Payment Gateway</td>
                                            <td>Educational Platform</td>
                                            <td>Moksh@Bidding24×7.Com</td>
                                            <td>14 Jan 2024</td>
                                            <td>14 Dec 2024</td>
                                            <td><span class="badge  succes-bg ">Good</span></td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <td>Payment Gateway</td>
                                            <td>Educational Platform</td>
                                            <td>Moksh@Bidding24×7.Com</td>
                                            <td>14 Jan 2024</td>
                                            <td>14 Dec 2024</td>
                                            <td><span class="badge  succes-bg ">Good</span></td>
                                            <td>
                                                <ul class="action-icons edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li>
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
                                            <th>Name</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Shift Type</th>
                                            <th>Shift Date</th>
                                            <th>Total Hours</th>
                                            <th>Assigned By</th>
                                            <th>Overtime Hours</th>
                                            <th>Status</th>
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  danger-bg ">Inactive</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
                                            <td>Kimberley Myers</td>
                                            <td>09:00</td>
                                            <td>17:00</td>
                                            <td>Day</td>
                                            <td>11/27/2024</td>
                                            <td>8</td>
                                            <td>HR Manager</td>
                                            <td>0</td>
                                            <td><span class="badge  succes-bg ">Active</span></td>
                                            <td>
                                                <ul class="action-icons  edit d-flex list-unstyled gap-2 mb-0">
                                                    <li><span class="iconify" data-icon="iconoir:trash" data-inline="false" style="font-size: 24px;"></span></li>
                                                    <li><span class="iconify" data-icon="solar:pen-outline" data-inline="false" style="font-size: 24px;"></span></li> 
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
          src="https://img.icons8.com/ios/30/close-window.png"
          alt="close-window"
        />
      </div>

     
      <?php include '../partials/footer.php';?>