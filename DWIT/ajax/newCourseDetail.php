<?php include '../system/application_top.php'; 

$id = (int)$_POST['id'];

$data = $obj->selectDataByField('health_diploma', array('id', 'title', 'description'), array('id' => $id));
$subData = $obj->getAllDataByField('sub_health_diploma', array('id', 'title', 'description'), array('health_diploma_id' => $id), array('priority' => 'ASC'));

if($data != null):
	$result = "<h3 class='semester-header text-center'>".$data['title']."</h3>
            <div class='accordion' id='accordionExample'>";
    if($subData == null):        
		$result .= "<div class='card'>                       
		                    <div>
		                        <div class='card-body'>".
		                            $data['description']."
		                        </div>
		                    </div>
	        			</div>";
	endif;
    if($subData != null):
	    $count = 0; 
	    foreach ($subData as $subValue): 
	    	$count++;
			
			$result .= "	<div class='card'>
			                    <div class='card-header' id='heading".$count."'>
			                        <h3 class='mb-0'>
			                            <button class='btn btn-link collapsed subject-header' type='button' data-toggle='collapse' data-target='#collapse".$count."' aria-expanded='false' aria-controls='#collapse".$count."'>".
			                                   $subValue['title']."
			                            </button>
			                        </h3>
			                    </div>
			                        
			                    <div id='collapse".$count."' class='collapse ".($count==1 ? 'show' : '')."' aria-labelledby='heading".$count."' data-parent='#accordionExample'>
			                        <div class='card-body'>".
			                            $subValue['description']."
			                        </div>
			                    </div>
	            			</div>";
		endforeach;
	endif;
else:
	$result .= "<div class='card'>
					<div class='card-header'>
		                <h2 class='mb-0'>
		                    <button class='btn btn-link subject-header' type='button'>
		                    		No Data Found
		                	</button>
		                </h2>
		            </div>
		        </div>";
endif;
$result .= "</div>";


echo json_encode(array("detail" => $result, "status" => 1));

?>

