<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;

        }
        .container{
            max-width:1180px;
            margin: 0 auto;
        }
        .description {
            border: 5px solid #000;
            filter: blur(40%);
            margin-bottom: 4rem;
        }
.postContent{
    margin-bottom: 2rem;
    border: solid #40ed5f 3px;
    box-shadow: 0px 0px 1rem #000;
    padding: 1rem;

}
        .postContent--avatar--pic {
            max-width: 400px;
        }

        h1{
            margin-bottom:.5rem;
        }
    </style>
</head>

<body>
    <?php

$data = json_decode(file_get_contents('baza_mammarzenie.json'), true);
?>

<header>
<div class="container">
    <div class="main-logo">
        <img src="https://www.google.pl/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=2ahUKEwjy5Pua7NPdAhUjlYsKHVVhBQwQjRx6BAgBEAU&url=https%3A%2F%2Ffanimani.pl%2Fblog%2Ffundacja-mam-marzenie%2F&psig=AOvVaw04u_5sB6uW4P4ZdtNs1A6r&ust=1537885533479702" alt="">
    </div>
</div>

</header>


        <div class="container">
            <?php
foreach($data as $post){

    ?>
                <div class="postContent">
                    <h1><?php echo $post['name'].' - '.$post['titleName']['span'].' | '.$post['wish'] .' | '?></h1>
                    <?php print_r($post['wishDay']);?>
                    <div class="postContent--avatar">
                        <img class="postContent--avatar--pic" src="<?php echo $post['avatar'];?>" alt="">
                        <span><?php print_r($post['wishDay']); ?></span>
                    </div>
                    <div class="postContent--desciption">
                        <?php echo $post['description'];?>
                        
                    </div>
                    <div class="postContent--gallery">
                    <?php 
                        foreach($post['gallery'] as $img){
                               ?>
<img src="<?php  echo $img; ?>" alt="" width="100px" height="auto">
                               <?php
                        }
                    ?>
                    </div>   
                    </div>
                    <?php
}
?>

                




                <!-- <script>
    $.getJSON("baza_mammarzenie.json", function(posts) {
    posts.forEach(function(post){
        
      
        let description = '<p class="description">'+post.description+'</p>';
        $(".postContent").append(description);

    })
});
</script> -->

        </div>

</body>

</html>