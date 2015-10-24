


    <div class="container">
      <div class="row">
       <p>Επιλέξετε δύο λεωφορεία για να δείτε τις κοινές στάσεις που έχουν</p>
          <form id="myForm" action="/bus_route" method="post" class="form-inline form-padding" role="form">
                  <div class="form-group col-md-4">
                     <label >Λεωφορείο </label>
            <div class="input-group col-md-4">
                <select id="bus1" name="bus1" class="form-control col-md-2 ">
                    <option value="0" selected="selected">Επιλογή....</option>
                    <?php foreach ($busdata as $category1):?>
                    <option value='<?php echo $category1['route_id']?>'><?php echo $category1['short_name'].' '.$category1['long_name'] ?></option>
                    <?php endforeach ;?>
                  </select>
            </div>
        </div>
                   <div class="form-group col-md-4">
                     <label >Λεωφορείο </label>
            <div class="input-group col-md-4">
                <select id="bus2" name="bus2" class="form-control col-md-2">
                    <option value="0" selected="selected">Επιλογή....</option>
                    <?php foreach ($busdata as $category2):?>
                    <option value='<?php echo $category2['route_id']?>'><?php echo $category2['short_name'].' '.$category2['long_name'] ?></option>
                    <?php endforeach ;?>
                  </select>
            </div>
        </div>
     
           
         
           <div class="form-group col-md-2">
          <button type="submit"  class="form-control btn btn-primary">Αναζήτηση</button>
          </div>
          </form>
     
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="output"></div>
        <div id="map" ></div>
      </div>
    </div>
 </div> 