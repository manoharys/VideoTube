function likeVideo(button, videoId){
    $.post("ajax/likeVideo.php",{videoId:videoId})
     .done(function(data){
        
        let likeButton = $(button);
        let disLikeButton = $(button).siblings(".disLikeButton");

        likeButton.addClass("active");
        disLikeButton.removeClass("active");
        
        let result = JSON.parse(data);
        console.log(result);
    });
    
}