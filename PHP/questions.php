// Question#1
function getQuestions($conn, $type = NULL, $programYear, $tournamentID) {
    $sql = "SELECT QID, Question, Options, Type FROM Questions WHERE Program_Year = ? AND Tournament_ID = ?";
    
    if ($type !== NULL) {
        $sql .= " AND Type = ?";
    }

    $stmt = $conn->prepare($sql);
    
    if ($type !== NULL) {
        $stmt->bind_param("iis", $programYear, $tournamentID, $type);
    } else {
        $stmt->bind_param("ii", $programYear, $tournamentID);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    $questions = $result->fetch_all(MYSQLI_ASSOC);
    
    return $questions;
}

// Question#2
function getAnswers($conn, $registrationID) {
    $sql = "SELECT QAID, Question_ID, Answer FROM Answers WHERE Registration_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $registrationID);
    $stmt->execute();
    $result = $stmt->get_result();
    $answers = $result->fetch_all(MYSQLI_ASSOC);

    return $answers;
}

// Sort both queries into one array
function getSortedData($conn, $programYear, $tournamentID, $registrationID, $type = NULL) {
    $questions = getQuestions($conn, $type, $programYear, $tournamentID);
    $answers = getAnswers($conn, $registrationID);

    $questionMap = [];
    foreach ($questions as $q) {
        $questionMap[$q['QID']] = $q['Question'];
    }

    $sortedData = [];
    foreach ($answers as $ans) {
        $qid = $ans['Question_ID'];
        $sortedData[$registrationID][$qid] = [
            'question' => $questionMap[$qid] ?? "Unknown Question",
            'answer' => $ans['Answer']
        ];
    }

    return $sortedData;
}
