<?php session_start();?>
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
        
        .row {
            background-color: beige;
            
        }
        
        tr td{
            display: block; 
            
        }
        
        body {
        background-color: dimgrey;
            color: white;
        }
        
        a {
         color: white;   
        }
        
        #links {
         color: lightskyblue;   
        }
        
        #sentences {
            font-style: italic;
            color: darkgray;
            text-indent: 2em;
            
        }
    </style>
        
         
</head>
    
    <body>
        
        
        <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="/">Crowd Stories</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="/">Home</a></li>
          <li><a href="createStory.php">Start a Story</a></li> 
        </ul>
        </div>
    </nav>

        
        <div class=" container-fixed container">
            
    
            <br>
            <div style="font-weight:normal;color:#EBEBEB;background-color:#2B3436;border: 5px solid #666E6A;letter-spacing:0pt;word-spacing:2pt;font-size:25px;text-align:center;font-family:arial, helvetica, sans-serif;line-height:4;">Crowd Stories</div>
            <br>
            
            <div class="container">
            <div class="col-md-4"></div> 
            <div class="col-md-4">
            <form method="post" action="createStory.php">
                <div class="form-group">
                <label for="formGroupExampleInput">Story Title:</label>
                <input type="text" class="form-control" name="title" placeholder="Title" value="dfsdfasdf">
                </div>
                <div class="form-group">
                <label for="formGroupExampleInput2">Initial Sentence:</label>
                <input type="text" class="form-control" name="initial_sentence" placeholder="Initial Sentence">
                </div>
                <div class="form-group">
                <label for="formGroupExampleInput2">Max Sentences:</label>
                <input type="text" class="form-control" name="max_sentences" placeholder="Default: 5">
                </div>
                <div class="form-group">
                <label for="formGroupExampleInput2">Votes to append to story:</label>
                <input type="text" class="form-control" name="max_votes" placeholder="Default: 5">
                </div>
                <div class="container">
                <div class="col-md-4"></div>

                <div class="form-group"> 
                    <input class="btn btn-primary center-block" value=" Send" type="submit">
                </div>

                

                <div class="col-md-4"></div>
            </div>
            </form>
            </div> 
            <div class="col-md-4"></div> 
            </div>
        
            <br>
            
            
        </div>
       
        
    </body>
    <?php
        if (isset($_POST['title'], $_POST['initial_sentence'])) {
            $mysqli =  mysqli_connect('localhost', 'homer', 'harambe', 'crowd_stories');

            $query = "INSERT INTO story (title, max_votes_per_sentence, max_num_sentences, first_sentence, text)
            VALUES (?, ?, ?, ?, ?)";
            if ($stmt = $mysqli->prepare($query))
            {
                $title = $_POST["title"];
                $max_votes_per = $_POST["max_votes"];
                $max_sentences = $_POST["max_sentences"];
                $first = $_POST["initial_sentence"];
                $text = $_POST["initial_sentence"];
                $stmt->bind_param("sssss", $title, $max_votes_per, $max_sentences, $first, $text);
                if (!$stmt->execute())
                    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
                
                //$stmt->store_result();
                $stmt->fetch();
                $stmt->close(); // close prepare statement
            }

            $mysqli->close();
        }
    ?>

</html>
