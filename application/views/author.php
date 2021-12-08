<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="basicInput">Titulus</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Írja be a szerző titulusát">
        </div>
    </div>    
    <div class="col-md-3">    
        <div class="form-group">
            <label for="basicInput"><b>Vezetéknév</b></label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Írja be a szerző vezetéknevét">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="basicInput"><b>Utónév</b></label>
           <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Írja be a szerző utónevét">
       </div>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-primary" id="authorsave" >Mentés</button> 
    </div>
</div>
<div class="row">
    <div class="alert alert-danger" id="authorErrorResponseMessage" style="display: none;">
        <h4 class="alert-heading">Hiba</h4>
        <p  id="authorErrorResponseMessageText" ></p>
    </div>
    <div class="alert alert-success" id="authorResponseMessage" style="display: none;">
        <h4 class="alert-heading">Sikeres művelet</h4>
        <p  id="authorResponseMessageText" ></p>
    </div>
</div>
<table id="authortable" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Titulus</th>
            <th>Vezetéknév</th>
            <th>Utónév</th>
            <th>Műveletek</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Id</th>
            <th>Titulus</th>
            <th>Vezetéknév</th>
            <th>Utónév</th>
            <th>Műveletek</th>
        </tr>
    </tfoot>
</table>