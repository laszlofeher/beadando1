<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Excel import</h4>
            </div>
            <form method="POST" enctype="multipart/form-data" action="index.php/Bookimport/upload">
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <p>Kérem válassza ki az importálandó excel file-t</p>
                            
                                <input type="file" id="xlsxfile" name="xlsxfile">
                                
                            
                        </div>
                    </div>
                    <?php 
                    if(isset($error)){
                        var_dump($error);
                    }
                    
                    if(isset($data)){
                        var_dump($data);
                    }
                    ?>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" >Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
