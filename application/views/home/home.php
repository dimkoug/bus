<div class="container">
  <div class="row">
    <center>
      <form id="myForm" action="/bus_route" method="post" class="well form-inline">
        <p>Επιλέξετε δύο λεωφορεία για να δείτε τις κοινές στάσεις που έχουν</p>
        <div class="form-group">
          <label >Λεωφορείο </label>
          <select id="bus1" name="bus1" class="form-control ">
            <option value="0" selected="selected">Επιλογή....</option>
              <?php foreach ($busdata as $category1):?>
                <option value='<?php echo $category1['route_id']?>'><?php echo $category1['short_name'].' '.$category1['long_name'] ?></option>
              <?php endforeach ;?>
            </select>
          </div>
          <div class="form-group">
            <label >Λεωφορείο </label>
            <select id="bus2" name="bus2" class="form-control">
              <option value="0" selected="selected">Επιλογή....</option>
                <?php foreach ($busdata as $category2):?>
                  <option value='<?php echo $category2['route_id']?>'><?php echo $category2['short_name'].' '.$category2['long_name'] ?></option>
                <?php endforeach ;?>
              </select>
            </div>
            <div class="row ">
              <div class="form-group pull-right">
                <button type="submit"  class=" btn btn-primary">Αναζήτηση</button>
              </div>
            </div>
          </form>
      </center>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="output"></div>
        <div id="map" ></div>
      </div>
    </div>
</div> 