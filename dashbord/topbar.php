
<div class="topbar">
                  <nav class="navbar navbar-expand-lg navbar-light">
                     <div class="full">
                        <button type="button" id="sidebarCollapse" class="sidebar_toggle"><i class="fa fa-bars"></i></button>
                        <div class="logo_section">
                           <a href="index.html"><img class="img-responsive" src="images/logo/logo.jpeg" style="width: 100px;height: 100px; 	
                              display: inline-block;
                               border-radius: 100%;" alt="#" /></a>
                        </div>
                       <div class="right_topbar">
                           <div class="icon_info">
                              <ul>
                                 <br> <li><a href="#"><i class="fa fa-bell-o"></i><span class="badge"><?php
@include '../conn_db.php';
$query = "SELECT COUNT(*) AS total_messages FROM contacts";
$result = mysqli_query($conn, $query);
if ($result) {
 // Extraire le nombre de messages de la réponse de la requête
 $row = mysqli_fetch_assoc($result);
 $total_messages = $row['total_messages'];
} 
      
      echo $total_messages; ?></span></a></li>
                              </ul>
                              <ul class="user_profile_dd">
                                 <li>
                                    <a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="images/layout_img/admin.webp" alt="#" /><span class="name_user">Admin</span></a>
                                    <div class="dropdown-menu">
                                       <!-- <a class="dropdown-item" href="profile.html">My Profile</a> -->
                                       <a class="dropdown-item" href="changer_password.php">changer password</a>
                                       <!-- <a class="dropdown-item" href="help.html">Help</a> -->
                                       <a class="dropdown-item" href="logout.php"><span>Log Out</span> <i class="fa fa-sign-out"></i></a>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </nav>
               </div>