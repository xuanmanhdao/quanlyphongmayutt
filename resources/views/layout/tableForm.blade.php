 @extends('layout.master')
 @section('tableForm')
     {{-- start page content --}}
     <table class="table table-bordered table-centered mb-0">
         <thead>
             <tr>
                 <th>User</th>
                 <th>Account No.</th>
                 <th>Balance</th>
                 <th>Action</th>
                 <th>Block</th>
             </tr>
         </thead>
         <tbody>
             <tr>
                 <td class="table-user">
                     <img src="assets/images/users/avatar-2.jpg" alt="table-user" class="mr-2 rounded-circle" />
                     Risa D. Pearson
                 </td>
                 <td>AC336 508 2157</td>
                 <td>July 24, 1950</td>
                 <td class="table-action">
                     <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                     <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                 </td>
                 <td>
                     <!-- Switch-->
                     <div>
                         <input type="checkbox" id="switch6" checked data-switch="success" />
                         <label for="switch6" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                     </div>
                 </td>
             </tr>
             <tr>
                 <td class="table-user">
                     <img src="assets/images/users/avatar-3.jpg" alt="table-user" class="mr-2 rounded-circle" />
                     Ann C. Thompson
                 </td>
                 <td>SB646 473 2057</td>
                 <td>January 25, 1959</td>
                 <td class="table-action">
                     <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                     <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                 </td>
                 <td>
                     <!-- Switch-->
                     <div>
                         <input type="checkbox" id="switch7" checked data-switch="success" />
                         <label for="switch7" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                     </div>
                 </td>
             </tr>
             <tr>
                 <td class="table-user">
                     <img src="assets/images/users/avatar-4.jpg" alt="table-user" class="mr-2 rounded-circle" />
                     Paul J. Friend
                 </td>
                 <td>DL281 308 0793</td>
                 <td>September 1, 1939</td>
                 <td class="table-action">
                     <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                     <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                 </td>
                 <td>
                     <!-- Switch-->
                     <div>
                         <input type="checkbox" id="switch8" checked data-switch="success" />
                         <label for="switch8" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                     </div>
                 </td>
             </tr>
             <tr>
                 <td class="table-user">
                     <img src="assets/images/users/avatar-5.jpg" alt="table-user" class="mr-2 rounded-circle" />
                     Sean C. Nguyen
                 </td>
                 <td>CA269 714 6825</td>
                 <td>February 5, 1994</td>
                 <td class="table-action">
                     <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                     <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                 </td>
                 <td>
                     <!-- Switch-->
                     <div>
                         <input type="checkbox" id="switch9" checked data-switch="success" />
                         <label for="switch9" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                     </div>
                 </td>
             </tr>
         </tbody>
     </table>
     {{-- end page content --}}
 @endsection
