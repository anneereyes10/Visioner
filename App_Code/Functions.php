<?php
$clsFn = new Functions();
class Functions{

  	public function __construct(){}

  	public function setForm($name, &$mdl, $required=false){
  		$msg = "";

  		if(isset($_POST[$name]) && $_POST[$name] != ""){
  			$mdl->{'set'.$name}($_POST[$name]);
  		}else{
  			if($required){
  				$msg .= "<p>";
  				$msg .= "<a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"input".$name."\")'>".$name."</a> missing.";
  				$msg .= "</p>";
  			}
  		}

  		return $msg;
  	}

    public function Pagination($page=1, $totalItem=0, $btnperPage=5,$perPage=10)
    {
      $pageQuery = '';
      foreach ($_GET as $key => $value) {
        if($key != "page"){
          $pageQuery .= $key ."=". $value ."&";
        }
      }
      $maxPage = $totalItem/$perPage;
      $btnStart = floor(($page-1)/$btnperPage)*$btnperPage;
      ?>

      <nav class="d-flex">
        <ul class="pagination mx-auto justify-content-center">
          <li class="page-item <?php echo ((($btnStart) <=1)?'disabled':''); ?>">
            <a class="page-link" href="? <?php echo $pageQuery; ?>page=<?php echo($btnStart);?>" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>

          <?php
          for ($i=1; $i < $btnperPage+1; $i++) {
            if($maxPage >= ($btnStart+$i)){
              echo '<li class="page-item '.((($btnStart+$i)==$page)?'active':'').'"><a class="page-link" href="?'.$pageQuery.'page='.($btnStart+$i).'">'.($btnStart+$i).'</a></li>';
            }
          }
          ?>

          <li class="page-item <?php echo ((($btnStart+$i+1) <= $maxPage)?'':'disabled'); ?>">
            <a class="page-link" href="? <?php echo $pageQuery; ?>page=<?php echo($btnStart+6);?>" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
      <?php
    }

    public function IsLogged(){
      if (empty($_SESSION['uid'])) {
        header("Location: ../index.php?login");
        exit();
      }
    }
}
