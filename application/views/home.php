<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Voler Admin Dashboard</title>
        <base href="<?php print(base_url()); ?>" >
        <link rel="stylesheet" href="assets/css/bootstrap.css">

        <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
        <link rel="stylesheet" href="assets/css/app.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
    </head>
    <body>
        <div id="app">
            <?php  $this->load->view('sidebarmenu'); ?>
            <div id="main">
                <nav class="navbar navbar-header navbar-expand navbar-light">
                    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                    <button class="btn navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">

                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                    <div class="avatar mr-1">
                                        <img src="assets/images/avatar/avatar-s-1.png" alt="" srcset="">
                                    </div>
                                    <div class="d-none d-md-block d-lg-inline-block">Hi, <?php if (isset($username)) {
    print($username);
} ?></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="index.php/Account/index"><i data-feather="user"></i> Account</a>

                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php/Home/logout"><i data-feather="log-out"></i> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="main-content container-fluid">
                    <div class="page-title">
                        <h3>Dashboard</h3>
                        <p class="text-subtitle text-muted">A good dashboard to display your statistics</p>
                    </div>
                    <section class="section">
                        <div class="row mb-2">
                            
                            <?php
                            if(isset($page)){
                                $this->load->view($page);
                            }
                            ?>
                            
                            
                        </div>
                        
                    </section>
                </div>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-left">
                            <p>2020 &copy; Voler</p>
                        </div>
                        <div class="float-right">
                            <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a href="http://ahmadsaugi.com">Ahmad Saugi</a></p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/feather-icons/feather.min.js"></script>
        <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script src="assets/js/app.js"></script>

        <script src="assets/vendors/chartjs/Chart.min.js"></script>
        <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
        <!--<script src="assets/js/pages/dashboard.js"></script>-->
        <script src="assets/js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script>
        $(document).ready( function () {    
            if($('#authorsave').length > 0){
                $('#authorsave').on('click', function(){
                    console.log('a mentés gombot valaki megnyomta');
                    if($('#firstname').val().length > 0 && $('#lastname').val().length > 0){
                        $('#authorErrorResponseMessage').hide();
                        $.post( "index.php/Author/save",
                        { titulus: $('#title').val(),
                          vezeteknev: $('#firstname').val(),
                          utonev: $('#lastname').val()})
                        .done(function( data ) {
                          console.log(data);
                          var obj = JSON.parse(data);
                          if(obj.error == 0){
                              console.log('Minden rendben');
                              $('#authorErrorResponseMessage').hide();
                              $('#authorResponseMessageText').html('A mentés sikeres!');
                              $('#authorResponseMessage').show();
                              $('#title').val('');
                              $('#firstname').val('');
                              $('#lastname').val('');
                              $('#authortable').DataTable().ajax.reload();
                          }else if(obj.error == 1){
                              $('#authorResponseMessage').hide(); 
                              $('#authorErrorResponseMessageText').html(obj.errorMessage);
                              $('#authorErrorResponseMessage').show();
                          }
                        });
                    }else{
                        $('#authorResponseMessage').hide(); 
                        $('#authorErrorResponseMessageText').html('Kérem töltse ki a vezetéknevet és utónevet!');
                        $('#authorErrorResponseMessage').show();
                    }
                });
            }
            if($('#authortable').length > 0){
                var table = $('#authortable').DataTable( {
                    "ajax": 'index.php/Author/authors',
                    "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<button class=\"btn btn-primary\" data-func=\"update\">Módosítás</button><button class=\"btn btn-primary\"  data-func=\"delete\">Törlés</button>"
                    }]
                });

                $('#authortable tbody').on( 'click', 'button', function () {
                    var data = table.row( $(this).parents('tr') ).data();
                    //alert( data[ 2 ] );
                    
                    if($(this).data('func') == 'delete'){
                        console.log('Delete gombot nyomtuk meg '+data[0]);
                        $('#authorDeleteMessage').html('Valóban törölni szeretné a <b>'+data[2]+' '+data[3]+'</b> szerzőt?')
                        var authorDeleteModal = new bootstrap.Modal(document.getElementById('authorDeleteModal'));
                        authorDeleteModal.show();
                        $('#authorDeleteButton').data('id', data[0]);
                        
                        $('#authorDeleteButton').on('click', function(){
                            var authorId = $(this).data('id');
                            $.post( "index.php/Author/delete",
                                { id: authorId }
                            ).done(function( data ) {
                                var obj = JSON.parse(data);
                                if(obj.error == 0){
                                    authorDeleteModal.hide();
                                    $('#authortable').DataTable().ajax.reload();
                                }
                            });
                        });
                    }else if($(this).data('func') == 'update'){
                        console.log('Update gombot nyomtuk meg '+data[0]);
                        var authorUpdateModal = new bootstrap.Modal(document.getElementById('authorUpdateModal'));
                        authorUpdateModal.show();
                        $('#uid').val(data[0]);
                        $('#utitle').val(data[1]);
                        $('#ufirstname').val(data[2]);
                        $('#ulastname').val(data[3]);
                        $('#authorUpdateButton').on('click', function(){
                            var authorId = $(this).data('id');
                            $.post( "index.php/Author/save",
                                { id: $('#uid').val(),
                                  titulus: $('#utitle').val(),
                                  vezeteknev: $('#ufirstname').val(),
                                  utonev: $('#ulastname').val()
                                }
                            ).done(function( data ) {
                                var obj = JSON.parse(data);
                                if(obj.error == 0){
                                    authorUpdateModal.hide();
                                    $('#authortable').DataTable().ajax.reload();
                                }else if(obj.error == 1){
                                    $('#authorUpdateErrorResponseMessageText').html(obj.errorMessage);
                                    $('#authorUpdateErrorResponseMessage').show();
                                }
                            });
                        });
                    }
                });
            }
        });
        </script>
    <!-- Modal for delete message -->
    <div class="modal fade" id="authorDeleteModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Törlés!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <p id="authorDeleteMessage"></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nem</button>
            <button type="button" class="btn btn-primary" id="authorDeleteButton" data-id="-1">Igen</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal for update -->
    <div class="modal fade" id="authorUpdateModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Módosítás!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <input type="hidden" class="form-control" id="uid" name="uid" /> 
                <div class="form-group">
                    <label for="basicInput">Titulus</label>
                    <input type="text" class="form-control" id="utitle" name="utitle" placeholder="Írja be a szerző titulusát">
                </div>
                <div class="form-group">
                    <label for="basicInput"><b>Vezetéknév</b></label>
                    <input type="text" class="form-control" id="ufirstname" name="ufirstname" placeholder="Írja be a szerző vezetéknevét">
                </div>
                <div class="form-group">
                    <label for="basicInput"><b>Utónév</b></label>
                   <input type="text" class="form-control" id="ulastname" name="ulastname" placeholder="Írja be a szerző utónevét">
               </div>
                <div class="alert alert-danger" id="authorUpdateErrorResponseMessage" style="display: none;">
                    <h4 class="alert-heading">Hiba</h4>
                    <p  id="authorUpdateErrorResponseMessageText"></p>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
            <button type="button" class="btn btn-primary" id="authorUpdateButton" data-id="-1">Ment</button>
          </div>
        </div>
      </div>
    </div>    
        
        
        
        
        
    </body>
</html>
