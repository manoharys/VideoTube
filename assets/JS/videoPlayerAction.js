function likeVideo(button, videoId){
    $.post("ajax/likeVideo.php",{videoId:videoId})
     .done(function(data){
        alert(data);
    });
    
}