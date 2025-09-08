<?php include '../system/application_top.php'; 

$year = (int)$_POST['year'];
if($year < 1 || $year > 4)
	$year = 1;
$stream = (int)$_POST['stream'];
if($stream != 1 && $stream != 2)
	$stream = 1;

$mapping = array(1 => ["FIRST", 1, "SECOND", 2],
	2 => ['THIRD', 3, 'FOURTH', 4],
	3 => ['FIFTH', 5, 'SIXTH', 6],
	4 => ['SEVENTH', 7, 'EIGHTH', 8] 
);

$section1 = "<h3 class='semester-header text-center'>".$mapping[$year][0]." SEMESTER</h3>
            <div class='accordion' id='accordionExample'>";
            

            $data = $obj->selectAllDataByField('courses', array('code', 'subject', 'description'), array('sem' => $mapping[$year][1], 'stream' => $stream));
            if($data != null):
	            $count = 0; 
	            foreach ($data as $value): 
	            	$count++;
					
					$section1 .= "	<div class='card'>
					                    <div class='card-header' id='heading".$count."'>
					                        <h3 class='mb-0'>
					                            <button class='btn btn-link collapsed subject-header' type='button' data-toggle='collapse' data-target='#collapse".$count."' aria-expanded='false' aria-controls='#collapse".$count."'>".
					                                   $count.". ".$value['code'].": ".$value['subject']."
					                            </button>
					                        </h3>
					                    </div>
					                        
					                    <div id='collapse".$count."' class='collapse ".($count==1 ? 'show' : '')."' aria-labelledby='heading".$count."' data-parent='#accordionExample'>
					                        <div class='card-body'>".
					                            $value['description']."
					                        </div>
					                    </div>
	                    			</div>";
				endforeach;
			else:
				$section1 .= "<div class='card'>
								<div class='card-header'>
					                <h2 class='mb-0'>
					                    <button class='btn btn-link subject-header' type='button'>
					                    		No Data Found
					                	</button>
					                </h2>
					            </div>
					        </div>";
			endif;
$section1 .= "</div>";






$section2 = "<h3 class='semester-header text-center'>".$mapping[$year][2]." SEMESTER</h3>
            <div class='accordion' id='accordionExample2'>";
            

            $data = $obj->selectAllDataByField('courses', array('code', 'subject', 'description'), array('sem' => $mapping[$year][3], 'stream' => $stream));
            if($data != null):
            	$count = 0; 
            	foreach ($data as $value): 
	            	$count++;
					
					$section2 .= "	<div class='card'>
					                    <div class='card-header' id='heading".$count."'>
					                        <h3 class='mb-0'>
					                            <button class='btn btn-link collapsed subject-header' type='button' data-toggle='collapse' data-target='#collapseTwo".$count."' aria-expanded='false' aria-controls='#collapseTwo".$count."'>".
					                                   $count.". ".$value['code'].": ".$value['subject']."
					                            </button>
					                        </h3>
					                    </div>
					                        
					                    <div id='collapseTwo".$count."' class='collapse' aria-labelledby='headingTwo".$count."' data-parent='#accordionExample2'>
					                        <div class='card-body'>".
					                            $value['description']."
					                        </div>
					                    </div>
	                    			</div>";
				endforeach;
			else:
				$section2 .= "<div class='card'>
								<div class='card-header'>
					                <h2 class='mb-0'>
					                    <button class='btn btn-link subject-header' type='button'>
					                    		No Data Found
					                	</button>
					                </h2>
					            </div>
					        </div>";
			endif;
			
$section2 .= "</div>";


// $section2 = "<h3 class='semester-header text-center'>".$mapping[$year][2]." SEMESTER</h3>
//             <div class='accordion' id='accordionExample2'>";
            

//             $data = $obj->selectAllDataByField('courses', array('code', 'subject', 'description'), array('sem' => $mapping[$year][3], 'stream' => $stream));
//             $count = 0; 
//             foreach ($data as $value): 
//             	$count++;
				
// 				$section2 .= "	<div class='card'>
// 				                    <div class='card-header' id='heading".$count."'>
// 				                        <h2 class='mb-0'>
// 				                            <button class='btn btn-link collapsed subject-header' type='button' data-toggle='collapse' data-target='#collapseTwo".$count."' aria-expanded='false' aria-controls='#collapseTwo".$count."'>".
// 				                                   $count.". ".$value['code'].": ".$value['subject']."
// 				                            </button>
// 				                        </h2>
// 				                    </div>
				                        
// 				                    <div id='collapseTwo".$count."' class='collapseTwo' aria-labelledby='headingTwo".$count."' data-parent='#accordionExample'>
// 				                        <div class='card-body'>".
// 				                            $value['description']."
// 				                        </div>
// 				                    </div>
//                     			</div>";
// 			endforeach;
			
// $section2 .= "</div>";


$result = $section1."<br>".$section2;

echo json_encode(array("detail" => $result, "status" => 1));

?>

