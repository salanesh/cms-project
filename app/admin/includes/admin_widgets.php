       <!-- /.row -->

       <div class="row">
           <div class="col-lg-3 col-md-6">
               <div class="panel panel-primary">
                   <div class="panel-heading">
                       <div class="row">
                           <div class="col-xs-3">
                               <i class="fa fa-file-text fa-5x"></i>
                           </div>
                           <div class="col-xs-9 text-right">
                               <?php
                                $query = "SELECT COUNT(*) FROM posts";
                                $result = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $post_count = $row['COUNT(*)'];
                                }
                                ?>
                               <div class='huge'><?php echo $post_count; ?></div>
                               <div>Posts</div>
                           </div>
                       </div>
                   </div>
                   <a href="posts.php">
                       <div class="panel-footer">
                           <span class="pull-left">View Details</span>
                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                           <div class="clearfix"></div>
                       </div>
                   </a>
               </div>
           </div>
           <div class="col-lg-3 col-md-6">
               <div class="panel panel-green">
                   <div class="panel-heading">
                       <div class="row">
                           <div class="col-xs-3">
                               <i class="fa fa-comments fa-5x"></i>
                           </div>
                           <div class="col-xs-9 text-right">
                               <?php
                                $query = "SELECT COUNT(*) FROM comments";
                                $result = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $comment_count = $row['COUNT(*)'];
                                }
                                ?>
                               <div class='huge'><?php echo $comment_count; ?></div>
                               <div>Comments</div>
                           </div>
                       </div>
                   </div>
                   <a href="comments.php">
                       <div class="panel-footer">
                           <span class="pull-left">View Details</span>
                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                           <div class="clearfix"></div>
                       </div>
                   </a>
               </div>
           </div>
           <div class="col-lg-3 col-md-6">
               <div class="panel panel-yellow">
                   <div class="panel-heading">
                       <div class="row">
                           <div class="col-xs-3">
                               <i class="fa fa-user fa-5x"></i>
                           </div>
                           <div class="col-xs-9 text-right">
                               <?php
                                $query = "SELECT COUNT(*) FROM users";
                                $result = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $user_count = $row['COUNT(*)'];
                                }
                                ?>
                               <div class='huge'><?php echo $user_count; ?></div>
                               <div> Users</div>
                           </div>
                       </div>
                   </div>
                   <a href="users.php">
                       <div class="panel-footer">
                           <span class="pull-left">View Details</span>
                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                           <div class="clearfix"></div>
                       </div>
                   </a>
               </div>
           </div>
           <div class="col-lg-3 col-md-6">
               <div class="panel panel-red">
                   <div class="panel-heading">
                       <div class="row">
                           <div class="col-xs-3">
                               <i class="fa fa-list fa-5x"></i>
                           </div>
                           <div class="col-xs-9 text-right">
                               <?php
                                $query = "SELECT COUNT(*) FROM category";
                                $result = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $category_count = $row['COUNT(*)'];
                                }
                                ?>
                               <div class='huge'><?php echo $category_count; ?></div>
                               <div>Categories</div>
                           </div>
                       </div>
                   </div>
                   <a href="categories.php">
                       <div class="panel-footer">
                           <span class="pull-left">View Details</span>
                           <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                           <div class="clearfix"></div>
                       </div>
                   </a>
               </div>
           </div>
       </div>
       <?php
        $query = "SELECT COUNT(*) FROM posts WHERE post_status='Published'";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $published_post_count = $row['COUNT(*)'];
        }
        $query = "SELECT COUNT(*) FROM posts WHERE post_status='draft'";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $draft_post_count = $row['COUNT(*)'];
        }

        $query = "SELECT COUNT(*) FROM comments WHERE comment_status='unapproved'";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $unapproved_comment_count = $row['COUNT(*)'];
        }
        $query = "SELECT COUNT(*) FROM users WHERE user_role='subscriber'";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $subscriber_count = $row['COUNT(*)'];
        }
        ?>
       <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
       <script type="text/javascript">
           google.charts.load('current', {
               'packages': ['bar']
           });
           google.charts.setOnLoadCallback(drawChart);

           function drawChart() {
               var data = google.visualization.arrayToDataTable([
                   ['', 'Count'],
                   <?php
                    $element_text = ['Active Posts', 'Draft Posts', 'Published Posts', 'Categories', 'Users', 'Subscribers', 'Comments', 'Unapproved Comments'];
                    $element_count = [$post_count, $draft_post_count, $published_post_count, $category_count, $user_count, $subscriber_count, $comment_count, $unapproved_comment_count];
                    // $dumps = [];
                    for ($i = 0; $i < 8; $i++) {
                        echo  "['$element_text[$i]'" . "," . "$element_count[$i]],";
                    }
                    // print_r($dumps);
                    ?>
               ]);

               var options = {
                   chart: {
                       title: '',
                       subtitle: '',
                   }
               };
               var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

               chart.draw(data, google.charts.Bar.convertOptions(options));

           }
       </script>
       <div class="row">
           <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
       </div>
       <!-- /.row -->