<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$pgName = 'Club Details';
include('./include/header.php');

if(isset($_GET['name'])) {
    $slug = $_GET['name'];

    // Replace underscores with spaces
    $club_name = str_replace('_', ' ', $slug);

    // Capitalize the first letter of each word
    $club_name = ucwords($club_name);
    // Fetch club data from the database
    $getData = $obj->select("clubs", array("id","name", "introduction", "club_vision", "club_mission"), array('name' => $club_name));
    $clubDetails = $getData->fetch(PDO::FETCH_ASSOC); 
    $clubTenures = $obj->select("clubTenure", array("id", "president", "vice_president", "members","club_id","tenure"), array('club_id'=>$clubDetails['id']));
    $memberBios = $obj->select("memberBio", array("id", "name", "bio"));
    $bios = array();
    while($bio = $memberBios->fetch()){
        array_push($bios, $bio);
    }
    $tenures = array();
    while($row = $clubTenures->fetch()){
        array_push($tenures, $row);
    }
    $jsonData = json_encode($tenures);
    $members = array();
    foreach($tenures as $tenure){
        array_push($members, explode(",",$tenure['members']));
    }
    $jsonMembers = json_encode($members);
    $jsonBios = json_encode($bios);
}
?>

<head>
    <link rel="stylesheet" href="./assets/css/clubstyles.css" type="text/css">
</head>
<body>
    <main>  
        <section class="club-name-section">
            <div class="club-name">
                <?php echo $clubDetails['name'];?>
            </div>
        </section>
        <section class="club-introduction-section">
            <div class="left-division">
            <?php
                $imageFormats = ['png', 'jpg', 'jpeg', 'dng','JPG'];
                
                foreach ($imageFormats as $format) {
                    $imagePath = "./admin/uploads/clubs/{$clubDetails['name']}.$format";
                    if (file_exists($imagePath)) {
                        echo "<img class=\"club-image\" src=\"$imagePath\">";
                        break;
                    }
                }
            ?>
            </div>
            <div class="gap-between"></div>
            <div class="right-division">
                <div class="introduction">
                    <p class="arial">Introduction</p>
                    <p class="information"><?php echo $clubDetails['introduction'];?></p>
                </div>
                <div class="club-vision">
                    <p class="arial">Club Vision</p>
                    <p class="information"><?php echo $clubDetails['club_vision'];?></p>
                </div>
                <div class="club-mission">
                <p class="arial">Club Mission</p>
                <p class="information"><?php echo $clubDetails['club_mission'];?></p>
                </div>
            </div>
        </section>
    </main>
    <div class="button-section">
    <?php
    foreach($tenures as $tenure){?>
        <button class="button" value="<?php echo $tenure['id'];?>"><?php echo $tenure['tenure'];?></button>
    <?php
    }
    ?>
    </div>
    <hr class="line">
    <div class="club-lead-section" id="clubLeadSection">
        <p class="club-lead">Club Leads</p>
        <div class="club-lead-division" id="clubLeadDivision">
            <div class="club-member-box">
                
                <?php
                    $imageFormats = ['png', 'jpg', 'jpeg', 'dng','JPG'];
                    
                    foreach ($imageFormats as $format) {
                        $imagePath = "./admin/uploads/clubs/{$tenures[0]['president']}.$format";
                        if (file_exists($imagePath)) {
                            echo "<img class=\"member-photo\" src=\"$imagePath\">";
                            break;
                        }
                    }
                ?>
                <p class="member-name"><?php echo $tenures[0]['president'];?></p>
                <p class="member-position">President</p>
            </div>
            <div class="club-member-box">
                <?php
                    $imageFormats = ['png', 'jpg', 'jpeg', 'dng','JPG'];
                    
                    foreach ($imageFormats as $format) {
                        $imagePath = "./admin/uploads/clubs/{$tenures[0]['vice_president']}.$format";
                        if (file_exists($imagePath)) {
                            echo "<img class=\"member-photo\" src=\"$imagePath\">";
                            break;
                        }
                    }
                ?>
                <p class="member-name"><?php echo $tenures[0]['vice_president'];?></p>
                <p class="member-position">Vice-President</p>
            </div>
        </div>
        <div class="club-member-section">
            <p class="club-members">Club Members</p>
            <div class="club-member-division" id="clubMemberDivision">
                <?php
                foreach($members[0] as $member){?>
                <div class="club-member-box">
                    <?php
                        $imageFormats = ['png', 'jpg', 'jpeg', 'dng','JPG'];
                        
                        foreach ($imageFormats as $format) {
                            $imagePath = "./admin/uploads/clubs/{$member}.$format";
                            if (file_exists($imagePath)) {
                                echo "<img class=\"member-photo\" src=\"$imagePath\">";
                                break;
                            }
                        }
                    ?>
                    <p class="member-name"><?php echo $member;?></p>
                </div>
                <?php
                }
                ?>
            </div>
    </div>
</body>
<!-- ... Existing PHP and HTML code ... -->

<script>
    var jsData = <?php echo $jsonData; ?>;
    var bios = <?php echo $jsonBios; ?>;
    var clubLeadSection = document.getElementById("clubLeadSection");
    var clubLeadDivision = document.getElementById("clubLeadDivision");
    var clubMemberDivision = document.getElementById("clubMemberDivision");


    function getMemberBio(memberName) {
        var bioObj = bios.find(bio => bio.name === memberName);
        if (bioObj) {
            return bioObj.bio;
        }
        return "No bio available.";
    }

    var clubLeadBoxes = document.getElementsByClassName("club-member-box");

    for (var i = 0; i < clubLeadBoxes.length; i++) {
        // Store the original content in a data attribute
        clubLeadBoxes[i].setAttribute("data-original-content", clubLeadBoxes[i].innerHTML);

        clubLeadBoxes[i].addEventListener("mouseenter", function() {
            var memberNameElement = this.querySelector(".member-name");
            var memberName = memberNameElement ? memberNameElement.textContent : "Unknown Member";
            var memberBio = getMemberBio(memberName);
            this.innerHTML = `<div class="bio">${memberBio}</div>`;
        });

        clubLeadBoxes[i].addEventListener("mouseleave", function() {
            var originalContent = this.getAttribute("data-original-content");
            this.innerHTML = originalContent;
        });
    }

    var buttons = document.getElementsByClassName("button");
    var imageFormats = ['jpg', 'jpeg', 'png', 'dng', 'JPG'];

    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function () {
            var buttonValue = this.value;
            var selectedTenure = jsData.find(tenure => tenure.id == buttonValue);
            var members = selectedTenure.members.split(",");
            
            function getMemberImage(member) {
                for (var formatIndex = 0; formatIndex < imageFormats.length; formatIndex++) {
                    var imagePath = `./admin/uploads/clubs/${member}.${imageFormats[formatIndex]}`;
                    console.log(imagePath);
                    var image = new Image();
                    image.src = imagePath;
                    if (image.complete && image.naturalHeight !== 0) {
                        return imagePath;
                    }
                }
                return ''; // No suitable image found
            }
            
            clubLeadDivision.innerHTML = `
                <div class="club-lead-box">
                    <img src="${getMemberImage(selectedTenure.president)}" class="member-photo">
                    <p class="member-name">${selectedTenure.president}</p>
                    <p class="member-position">President</p>
                </div>
                <div class="club-lead-box">
                    <img src="${getMemberImage(selectedTenure.vice_president)}" class="member-photo">
                    <p class="member-name">${selectedTenure.vice_president}</p>
                    <p class="member-position">Vice-President</p>
                </div>
            `;
            
            clubMemberDivision.innerHTML = '';
            members.forEach(function (member) {
                var memberImagePath = getMemberImage(member);
                    clubMemberDivision.innerHTML += `
                        <div class="club-member-box">
                            <img src="${memberImagePath}" class="member-photo">
                            <p class="member-name">${member}</p>
                        </div>
                    `;
            });
        });
    }
</script>
<?php include('./include/footer.php'); ?>