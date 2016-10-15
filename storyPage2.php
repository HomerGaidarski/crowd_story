 <?php
    session_start();
    if (!isset($_SESSION['mysql'])) {
        $mysqli = mysqli_connect('localhost', 'homer', 'harambe', 'crowd_stories');   
    }

    function ragequit() {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        header('Location: /');
        $mysqli->close();
        exit;
    }

    

    if (isset($_GET["id"])) {
                         
                $query = "SELECT * FROM story WHERE story_id=?";

                if ($stmt = $mysqli->prepare($query))
                {
                    $stmt->bind_param("i", $_GET["id"]);
                    if (!$stmt->execute()) {
                        ragequit();
                    }
                    
                    $stmt->store_result();
                    $stmt->bind_result($id, $title, $first, $text, $create_date, $max_votes_per, $max_num_sentences, $total_sentences, $total_votes);
                    if (!$stmt->fetch()) {
                        ragequit();
                    }
                    $stmt->close(); // close prepare statement
                } else {
                    ragequit();
                }
                $mysqli->close();
    }

    if (isset($_POST["upboat"]) && !isset($_SESSION['voted'])) {
        $query = "UPDATE sentence SET vote_count = (vote_count + 1) WHERE id = ",  ";"
    }
    
    if (isset($_POST['nextSentence'])) {
        $query = "INSERT INTO sentence (story_id, text) VALUES(?, ?)";
        echo $query;
        if ($stmt = $mysqli->prepare($query)) {
            echo $_GET['id'];
            $stmt->bind_param("is", $_GET['id'], $_POST['nextSentence']);
            if (!$stmt->execute()) {
                ragequit();
            }
            
            $stmt->close();
        } else {
            echo 'bk';
        }
    } else
        echo 'you are so bad';
        ?>
<html>
    <head>
  <title>Crowd Stories</title>

        
        
        
        
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
     
    <style>
        
        
        
        body {
            background-color: dimgrey;
            color: white;
        }
        
        #comment {
            opacity: 50%;
            font-style: italic;
        }
        
        tr td{
            display: block; 
            opacity: 70%;
            
        }
        
    </style>
    
        <script src="http://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
        
</head>
    
    <body>
        
        
        <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="landingPage.html">Crowd Stories</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="landingPage.html">Home</a></li>
          <li><a href="createStory.html">Start a Story</a></li>
        </div>
    </nav>

        <form action="storyPage.php?id=<?php echo $id;?>" method="post">
    <div class=" container-fixed container">
            
    
        <br>
        <div style="font-weight:normal;color:#EBEBEB;background-color:#2B3436;border: 5px solid #666E6A;letter-spacing:0pt;word-spacing:2pt;font-size:25px;text-align:center;font-family:arial, helvetica, sans-serif;line-height:4;">Crowd Stories</div>
        <br>            <br>
        <div class="md-4"><h1><?php echo $title;?></h1></div> <div class="md-4"></div> <div class="md-4"></div>
        
        <br>            <br>
        <div class="md-4"></div> <div class="md-4"><h4></h4><?php echo $text;?></h4></div> <div class="md-4"></div>
        <br>
        <br>            
        <label for="comment">Your sentence:</label>
        <input class="form-control" rows="5" name="nextSentence" type="text">

    </div>
    <br>
    <br>
    
    <table class="table table-inverse">
              <thead>
                <tr>
                  <th>#</th>
                  <th>User Submitted Sentences</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                    <td>
                        <h6>sentence</h6>
                        <form method="post" action="storyPage2.php">
                            <input style="float:right;" type="submit" name="upboat" class="btn glyphicon glyphicon-circle-arrow-up">
                        </form>
                    </td>
                </tr>
              </tbody>
            </table>
        </form>
        
    </body>
    
</html>
