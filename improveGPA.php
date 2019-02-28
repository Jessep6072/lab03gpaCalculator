<!DOCTYPE html>
<html lang="en">

<head>
    <title>GPA Improvement Calculator</title>
    <style>
        .error {
          color: #FF0000;
        }
    </style>
</head>
<?php
    $name = '';
    $email = '';
    $checked = '';
    $currCred = '';
    $newCred = '';
    $currGPA = '';
    $incGPA = '';

    $nameError = '';
    $emailError = '';
    $checkError = '';
    $currGPAError = '';
    $currCredError = '';
    $newCredError = '';
    $incGPAError = '';

?>
<body>
    <h1>GPA Improvement Calculator</h1>

    <p><span class="error">All form fields must be completed for the GPA calculator to function.</span></p>

    <form method="post" action="improveGPA.php">
        <?php

        $aTags = '<span class="error">';
        $bTags = '</span>';

        if(isset($_POST['submit'])) {
            $name = $_POST['name'];
            if (!preg_match('/^[A-Za-z ]*$/', $name)) {
                $nameError = "(Please enter a valid name with no numbers or symbols.)";

            }
        }

        ?>
        Name: <input type="text" size="35" name="name" value= "<?php echo $name; ?>" >
        <?php echo $aTags.$nameError.$bTags; ?>
        <br><br>
        <?php

        if(isset($_POST['submit'])) {
            $email = $_POST['email'];
            if (!preg_match('/^[A-Za-z0-9]+@[A-Za-z0-9]+.[A-Za-z]+$/', $email)) {
                $emailError = "(Please enter a valid email with only @ symbols or periods(.))";

            }
        }

        ?>
        E-mail: <input type="text" size="35" name="email" value= "<?php echo $email; ?>" >
        <?php echo $aTags.$emailError.$bTags; ?>
        <br><br>

        <?php
        if(isset($_POST['submit'])) {

            if (!isset($_POST['agree'])) {
                $checkError = "(Please verify that you agree to the terms and conditions.)";
                echo "<input type=\"checkbox\" name=\"agree\"  >";
            } else {
                echo "<input type=\"checkbox\" name=\"agree\" checked >";
            }

        }
        else{
            echo "<input type=\"checkbox\" name=\"agree\"  >";
        }
        ?>

        I agree to the terms and conditions of this website.
        <?php echo '<br>'.$aTags.$checkError.$bTags; ?>

        <br><br>
        <?php

        if(isset($_POST['submit'])) {
            $currGPA = $_POST['currentGPA'];
            if (!preg_match('/^[0-9].[0-9]+$/', $currGPA) || ($currGPA > 4.0)) {
                $currGPAError = "(Please enter a valid GPA)";

            }
        }

        ?>
        Current GPA: <input type="text" size="4" name="currentGPA" value= <?php echo $currGPA; ?> >
        <?php echo $aTags.$currGPAError.$bTags; ?>
        <br><br>
        <?php

        if(isset($_POST['submit'])) {
            $currCred = $_POST['currentCredits'];
            if (!preg_match('/^[0-9]+$/', $currCred) || ($currCred < 0)) {
                $currCredError = "(Please enter a valid number of credit hours)";
                if ($currCred < 0){
                    $currCredError = "(Your current number of credits must be a positive integer)";
                }

            }
        }

        ?>
        Current Total Credits: <input type="text" size="3" name="currentCredits" value= "<?php echo $currCred; ?>" >
        <?php echo $aTags.$currCredError.$bTags; ?>
        <br><br>

        <?php

        if(isset($_POST['submit'])) {
            $newCred = $_POST['newCredits'];
            if (!preg_match('/^[0-9]+$/', $newCred) || ($newCred <= 0)) {
                $newCredError = "(Please enter a valid number of credit hours)";

            }
        }

        ?>
        I am taking <input type="text" size="3" name="newCredits" value= "<?php echo $newCred; ?>" >
        <?php echo $aTags.$newCredError.$bTags; ?>
        credits this semester.

        If I want to raise my GPA
        <?php

        if(isset($_POST['submit'])) {
            $incGPA = $_POST['GPAincrease'];
            if (!preg_match('/^[0-9].[0-9]+$/', $incGPA) || ($incGPA < 0)) {
                $incGPAError = "(Please enter a valid number of credit hours)";

            }
        }

        ?>
        <input type="text" size="4" name="GPAincrease" value="<?php echo $incGPA; ?>">
        <?php echo $aTags.$incGPAError.$bTags; ?>
         points,
        I need a <span style="font-weight: bold;"><?php
                $currentGPAhours = $currGPA * $currCred;
                $desiredGPA = $currGPA + $incGPA;
                $desiredGPAhours = $desiredGPA * ($currCred + $newCred);
                $GPAhoursincrease = $desiredGPAhours - $currentGPAhours;
                $newGPA = $GPAhoursincrease / $newCred;
                if($nameError <> '' || $emailError <> '' || $currGPAError <> '' || $currCredError <> '' || $newCredError <> '' || $incGPAError <> '' || $checkError <> '' ){
                    echo "????";
                }
                else {
                    echo $newGPA;
                }
            ?></span> GPA on my courses this semester.
        <br><br>

        <input type="submit" name="submit" value="Calculate">

    </form>

</body>

</html>
