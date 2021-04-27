<?php
session_start();

if(!isset($_SESSION['Login']) )
{
  die("unauthorized user!");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script type = "text/javascript" src = "./javascript/search.js"></script>
    <script type = "text/javascript" src = "./javascript/menujsfuncs.js"></script>
    <script type = "text/javascript" src = "./javascript/medjsfuncs.js"></script>
    <script type = "text/javascript" src = "./javascript/allergyfuncsjs.js"></script>
    <script type = "text/javascript" src = "./javascript/tlkpDropdownFunc.js"></script>
    <script type = "text/javascript" src = "./javascript/sickjsfuncs.js"></script>

    <title>Med Menu | NGYCP</title>
  </head>
  <body>
    <?php
    //php imports
    require_once './medform.php';
    require_once './search-person-form.php';
    require_once './insurance-menu.php';
    require_once './allergy.php';
    require_once './sickcallform.php';
    require_once './sqlsts.php';

    ?>
  	<a href = "./logout.php">Log out</a>
    <div class = "row">
  		<!-- person search panel -->
  		<div class = "col-sm-3 y-scrollable screen-height">
  			<?php
          $displayFN = "";
          $displayLN = "";
          $displayDOB = "";
          if(isset($_POST['PersonFN']) && isset($_POST['PersonLN']) && isset($_POST['PDOB']))
          {
            $displayFN = sanitizeString($_POST['PersonFN']);
            $displayLN = sanitizeString($_POST['PersonLN']);
            $displayDOB = sanitizeString($_POST['PDOB']);
          }
    				search_person_form_main($displayFN, $displayLN, $displayDOB);
  			?>
  		</div> <!-- end person search panel -->
  		<div class = "col-sm-9"> <!-- menus panel -->
  		
  		<!-- <div id = "selectedInfo"></div> -->
      <?php
        if(isset($_POST['PersonFN']) && isset($_POST['PersonLN']) )
        {
          $displayFN = sanitizeString($_POST['PersonFN']);
          $displayLN = sanitizeString($_POST['PersonLN']);
          $arr = explode("|",  sanitizeString($_POST['cadetIDs']));
          $displayPID = $arr[0];
          $_SESSION['PersonID'] = $displayPID;
          $displayCID = $arr[1];
          $_SESSION['CadetID'] = $displayCID;
          echo <<<_END
          <h4>Currently Accessing Information For:</h4>
          <h1>$displayFN $displayLN</h1>
          <h4> PersonID: $displayPID CadetID: $displayCID </h4>
_END;
        }
      ?>

      	<div id="accordion">
      	  <div class="card">
      	    <div class="card-header" id="headingOne">
      	      <h5 class="mb-0">
      	        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      	          Insurance and Primary Doctor Information
      	        </button>
      	      </h5>
      	    </div>
      	    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      	      <div class="card-body">
      	        <?php
  				    insurance_main();
  			    ?>
              </div>
            </div> 
          </div> <!-- menu 1 -->
    
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Sick Call / SOAP Notes
                </button>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <div id="sickcalldiv">
        			    <?php
        				    sickcallform_main();
        			    ?>
      			    </div>
              </div>
            </div>
          </div> <!-- menu 2 -->
    
          <div class="card">
            <div class="card-header" id="headingThree">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Allergies
                </button>
              </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <div id = "allergydiv">
                  <?php
                    allergy_main();
                  ?>
                </div>
              </div>
            </div>
          </div> <!-- menu 3 -->
    
          <div class="card">
            <div class="card-header" id="headingFour">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  Medications
                </button>
              </h5>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
              <div class="card-body">
                    <div id = "medformdiv">
                    <?php
                      medform_main();
                    ?>
                    </div>
              </div>
            </div>
          </div> <!-- menu 4 -->
    
        </div> 
  	
      		</div> <!-- end menus panel -->
  		
  	</div> <!-- row -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>