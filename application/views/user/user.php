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
              <li ><a href="/">Home</a></li>
            <li class="active" ><a href="/user_loc">Location-based search</a></li>
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
      <P>Εισάγετε την διέυθυνση σας και πατήσετε αναζήτηση μόλις εμφανιστεί στον χάρτη ο κύκλος σύρετε τον στον χάρτη για να δείτε τις στάσεις των λεωφορείων</P>
      
      <div class="row">
        <div class="col-md-12">
                  <form id="myForm"  class="form-inline input-small" role="form">
    <input id="address" type="text" class="form-control" placeholder="Εισαγωγή Διεύθυνσης" />
   <div class="form-group input-small">
 <button type="button"  id="bus" class="btn btn-primary">Αναζήτηση</button>
</div>
</form>



        </div>



      </div>
      <div class="row">
        <div class="col-md-12">
          <div id="res"></div>
           <div id="map" ></div>


        </div>
       

      </div>
    </div> 