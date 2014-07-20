<?php
// $_SESSION['id3'] contains id college major [0][1][2]

function get_mentors_3() {
    require("common.php");
    try {
        $results= $db->query("
            SELECT id, college, major
            FROM mentors
            ORDER BY RAND()
            LIMIT 3");

    } catch (Exception $e) {

        echo "de";
        exit;
    }
    $mentor3fixed = $results->fetchALL(PDO::FETCH_NUM);

    usort($mentor3fixed, function($a, $b) {
    return $a[0] - $b[0];
    });

    

    $_SESSION['id3']=$mentor3fixed;

    $paramsfind3 = array( 
            ':id' => $mentor3fixed[0][0],
            ':id1'=> $mentor3fixed[1][0],
            ':id2'=> $mentor3fixed[2][0]
              ); 
           
    $queryfind3 = " 
        SELECT  
        username, email
        FROM userz
        WHERE 
        id IN (:id, :id1, :id2)
        "; 

        try 
        { 
            $stmtfind3 = $db->prepare($queryfind3); 
            $resultfind3 = $stmtfind3->execute($paramsfind3); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run find mentor query: " . $ex->getMessage()); 
        } 
         
        
        $names3 = $stmtfind3->fetchALL(PDO::FETCH_ASSOC); 

        $_SESSION['names3'] = $names3; 

         $paramsprof3 = array( 
            ':id' => $mentor3fixed[0][0],
            ':id1'=> $mentor3fixed[1][0],
            ':id2'=> $mentor3fixed[2][0]
              ); 


            
        $prof3query = " 
        SELECT  
                genderpref, 
                id,
                female, 
                hschool, 
                math,
                english,
                history,
                chemistry,
                economics,
                engineering,
                physics,
                computers,
                biology,
                art,
                music,
                literature,
                extra1,
                extra2,
                extra3,
                extra4,
                extra5,
                academics,
                career,
                sociallife,
                applications,
                scholarship,
                transitioning,
                email,
                inperson,
                vchat,
                phone,
                im,
                other,
                zipcode,
                time,
                available,
                me,
                photo

                FROM profiles
                WHERE 
                id IN (:id, :id1, :id2)
                "; 



        try 
        { 
            // Execute the query against the database 
            $stmtprof3 = $db->prepare($prof3query); 
            $resultprof3 = $stmtprof3->execute($paramsprof3); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run find mentor query: " . $ex->getMessage()); 
        } 
         
        
        $prof3 = $stmtprof3->fetchALL(PDO::FETCH_ASSOC); 

        $_SESSION['prof3'] = $prof3; 

     

               
}


?>

