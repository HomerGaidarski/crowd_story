        <?php
                $mysqli =  mysqli_connect('localhost', 'homer', 'harambe', 'crowd_stories');            
                $query = "SELECT story_id, title, first_sentence, total_votes FROM story ORDER BY total_votes DESC";

                if ($stmt = $mysqli->prepare($query))
                {
                    //echo "hello";
                    //Get the stored salt and hash as $dbSalt and $dbHash
                    if (!$stmt->execute())
                        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            
                    //  echo "hello2";
                    $stmt->store_result();
                    //  echo "hello3";
                    $stmt->bind_result($story_id, $title, $first_sentence, $total_votes);
            
                    //   echo "hello4";
                    for ($i=0, $arr=[]; $stmt->fetch(); $i++) {
                        $row = new stdClass();
                        $row->id = $story_id;
                        $row->title = $title;
                        $row->first = $first_sentence;
                        $row->total_votes = $total_votes;
                        $arr[$i] = $row;
                    }
            
                    $stmt->close(); // close prepare statement
                }
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
                <li><a href="createStory.php">Start a Story</a></li>
            </ul>
        </div>
    </nav>

        
        <div class=" container-fixed container">
            
    
            <br>
            <div style="font-weight:normal;color:#EBEBEB;background-color:#2B3436;border: 5px solid #666E6A;letter-spacing:0pt;word-spacing:2pt;font-size:25px;text-align:center;font-family:arial, helvetica, sans-serif;line-height:4;">Crowd Stories</div>
            <br>
            <table class="table table-inverse">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    foreach ($arr as $i => $story) {       
                ?>
                <tr>
                  <th scope="row"><?php echo $i+1;?></th>
                    <td>
                        <a id="links" href="<?php echo "/storyPage.php?id=", $story->id;?>">
                            <div class="col-md-4"><?php echo $story->title;?></div>
                        </a>
                        <div class="col-md-6" id="sentences"><?php echo $story->first;?></div>
                        <div style="float:right;" type="button">+<?php echo $story->total_votes;?>
                    </div>
                </td>      
                </tr>
                <?php
                    }
                ?>
                <!--tr>
                    <th scope="row">2</th>
                    <td><a id="links" href="PHP"><div class="col-md-4">How Chewy got sued for sexual harrasment:</div></a><div class="col-md-4" id="sentences">This is the first sentence in the story</div><div style="float:right;" type="button">+95<div class="btn glyphicon glyphicon-circle-arrow-up"></div></div></td>

                    
                    
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td><a id="links" href="PHP"><div class="col-md-4">How Chewy got sued for sexual harrasment:</div></a><div class="col-md-4" id="sentences">This is the first sentence in the story</div><div style="float:right;" type="button">+95<div class="btn glyphicon glyphicon-circle-arrow-up"></div></div></td>
                    
                    
                </tr-->
              </tbody>
            </table>
            
            
        </div>
    </body>
</html>
