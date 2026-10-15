<?php 
    $data = $_SESSION['form-data']??[];
?>

<div id = "new-or-update-form" class = "">
    <label>First Name</label>
        <input type="text" name = "firstname" placeholder = "eg. Isabelle" value = "<?php echo htmlspecialchars($data['name'] ?? '') ?>">

    <label>Surname</label>
        <input type="text" name = "surname" placeholder = "eg. Lynch" value = "<?php echo htmlspecialchars($data['surname'] ?? '') ?>">

    <label>Email</label>
        <input type="email" name = "email" placeholder = "eg. isabelle@gmail.com" value = "<?php echo htmlspecialchars($data['email'] ?? '') ?>">

    <label>Phone Number</label>
        <input type="tel" name = "phone" placeholder = "eg. 086-1231233" value = "<?php echo htmlspecialchars($data['phone'] ?? '') ?>">

    <?php 
        require_once(ROOT . "/database-interactions/general.php");

        $page = getCurrentPage();

        if($page === "Tutors"):
            require_once(ROOT . "/database-interactions/tutors.php");
            require_once(ROOT . "/database-interactions/subjects.php");
            $rates = GetTutorRates() ?? [];
            $subjects = GetSubjectNames() ?? [];
            $selectedRate = $data['rate'] ?? '';
            $selectedSubject = $data['subject'] ?? '';
        ?>

        <label>Subject</label>
        <select id = "subject" name = "subject">
            <option value = "" disabled <?php echo ($selectedSubject === '') ? 'selected' : ''; ?> hidden>Select subject...</option>
            <?php foreach($subjects as $sub): ?>
                <option value = "<?php echo htmlspecialchars($sub['SubjectCode']); ?>"
                        <?php echo ($selectedSubject === $sub['SubjectCode']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($sub['Description']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Rate</label>
        <select id = "rate" name = "rate">
            <option value = "" disabled <?php echo ($selectedRate === '') ? 'selected' : ''; ?> hidden>Select rate...</option>
            <?php foreach($rates as $r): ?>
                <option value = "<?php echo htmlspecialchars($r['RateCode']); ?>"
                        <?php echo ($selectedRate === $r['RateCode']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($r['RateCode']) . " - €" . (int)$r['HourlyRate']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php 
        endif; 
    ?>
    <input type="hidden" name = "update-id" value = "">
</div>