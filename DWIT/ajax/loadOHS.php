<?php
require_once("../system/application_top.php");

// ORIGINAL QUERY - Check for active/future sessions
$data = $obj->getFilterDataByLimit(
    'open_house',
    array(
        'id',
        'session_num',
        'session_time_1',
        'session_time_2',
        'date(session_date_1) as session_date_1',
        'date(session_date_2) as session_date_2'
    ),
    '(session_date_1 > CURRENT_DATE() || (session_date_1 = CURRENT_DATE && session_time_1 > CURTIME()) || session_date_2 > CURRENT_DATE() || (session_date_2 = CURRENT_DATE && session_time_2 > CURTIME()) ) && enable = 1',
    array('session_date_1' => 'asc')
);

// Check if there are active open house sessions
$hasActiveSessions = !empty($data) && isset($data[0]);

if ($hasActiveSessions) {
    // When sessions are active - show both divisions (improved layout)
    $sessionData = $data[0];

    $code = '
    <div class="ohs-popup-content">
        <button class="ohs-close-btn" onclick="closeModal()" aria-label="Close popup">&times;</button>

        <div class="ohs-multi-section">
            <div class="ohs-section ohs-left-section">
                <div>
                    <h2 class="ohs-title">
                        ADMISSION<br />
                        <span class="ohs-accent-blue">OPEN</span>
                    </h2>
                    <h5 class="ohs-subtitle">
                        NOW OPEN FOR <span class="ohs-accent-green">REGISTRATION</span>
                    </h5>
                    <h3 class="ohs-program-title">For BCA | BSc. CSIT</h3>
                </div>
                <a class="ohs-action-btn" target="_blank" href="https://deerwalk.edu.np/DWIT/preregister.php">
                    INQUIRE NOW
                </a>
            </div>

            <div class="ohs-section ohs-right-section">
                <div>
                    <h2 class="ohs-title">
                        OPEN HOUSE<br />
                        <span class="ohs-accent-blue">SESSION</span>
                    </h2>
                    <h5 class="ohs-subtitle">
                        NOW OPEN FOR <span class="ohs-accent-green">REGISTRATION</span>
                    </h5>
                    <h3 class="ohs-program-title">For BCA | BSc. CSIT</h3>
                    <div class="ohs-session-info">';

    // Format and display session dates
    if (strtotime($sessionData['session_date_2']) > 0) {
        // Two session dates
        $code .= '
                        <p>
                            <strong>' . date("l", strtotime($sessionData["session_date_1"])) . '</strong><br>
                            ' . date('d F, Y', strtotime($sessionData['session_date_1'])) . ' | ' .
            date("h:i A", strtotime($sessionData["session_time_1"])) . ' onwards
                        </p>
                        <p>
                            <strong>' . date("l", strtotime($sessionData["session_date_2"])) . '</strong><br>
                            ' . date('d F, Y', strtotime($sessionData['session_date_2'])) . ' | ' .
            date("h:i A", strtotime($sessionData["session_time_2"])) . ' onwards
                        </p>';
    } else {
        // Single session date
        $code .= '
                        <p>
                            <strong>' . date("l", strtotime($sessionData["session_date_1"])) . '</strong><br>
                            ' . date('d F, Y', strtotime($sessionData['session_date_1'])) . ' | ' .
            date("h:i A", strtotime($sessionData["session_time_1"])) . ' onwards
                        </p>';
    }

    $code .= '
                    </div>
                </div>
                <a class="ohs-action-btn" href="book-now.php?id=' . $sessionData["id"] . '">
                    ENROLL NOW
                </a>
            </div>
        </div>
    </div>
    <script>
function closeModal() {
    const modal = document.getElementById("welcomePopup");
    if (modal) {
        modal.classList.remove("show");
    }
}
</script>';
} else {
    $code = '

    <div class="ohs-popup-content">
    <button class="ohs-close-btn" onclick="closeModal()" aria-label="Close popup">&times;</button>

    <div class="ohs-multi-section">
        <!-- Left Block -->
        <div class="ohs-section">
                <h2 class="ohs-title">
                    ADMISSION<br />
                    <span class="ohs-accent-blue">OPEN</span>
                </h2>
                <h5 class="ohs-subtitle">
                    NOW OPEN FOR <span class="ohs-accent-green">REGISTRATION</span>
                </h5>
                <h3 class="ohs-program-title">For BCA | BSc. CSIT</h3>
            <a class="ohs-action-btn" target="_blank" href="https://application.deerwalk.edu.np/">
                APPLY NOW
            </a>
        </div>

        <!-- Right Block -->
        <div class="ohs-section">
                <h2 class="ohs-title">
                    ADMISSION <br />
                    <span class="ohs-accent-blue">INQUIRY</span>
                </h2>
                <h5 class="ohs-subtitle">
                    NOW OPEN FOR <span class="ohs-accent-green">REGISTRATION</span>
                </h5>
                <h3 class="ohs-program-title">For BCA | BSc. CSIT</h3>
            <a class="ohs-action-btn" target="_blank" href="https://deerwalk.edu.np/DWIT/contact.php">
                INQUIRE NOW
            </a>
        </div>
    </div>
</div>

<script>
function closeModal() {
    const modal = document.getElementById("welcomePopup");
    if (modal) {
        modal.classList.remove("show");
    }
}
</script>



';
}

$status = 0;

// Return JSON response
echo json_encode(array(
    'detail' => $code,
    'status' => $status
));
