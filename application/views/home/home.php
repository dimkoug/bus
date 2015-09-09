    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><i class="fa fa-home fa-2x"></i></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Home</a></li>
            <li ><a href="/user_loc">Location-based search</a></li>
            <!--<li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>-->
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <!--<li><a href="../navbar/">Default</a></li>
            <li class="active"><a href="./">Static top</a></li>
            <li><a href="../navbar-fixed-top/">Fixed top</a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


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