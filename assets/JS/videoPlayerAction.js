function likeVideo(button, videoId){
    $.post("ajax/likeVideo.php",{videoId:videoId})
     .done(function(data){
        
        let likeButton = $(button);
        let disLikeButton = $(button).siblings(".disLikeButton");

        likeButton.addClass("active");
        disLikeButton.removeClass("active");
        
        let result = JSON.parse(data);
         console.log(result);
        
        updateLikeValue(likeButton.find(".text"), result.likes)
        updateLikeValue(disLikeButton.find(".text"), result.disLikes)
        
        if(result.likes < 0){
            likeButton.removeClass("active");
            likeButton.find("img:first").attr("src","assets/images/icons/thumb-up.png");
        }else{
            likeButton.find("img:first").attr("src","assets/images/icons/thumb-up-active.png");
        }
         disLikeButton.find("img:first").attr("src","assets/images/icons/thumb-down.png");

     });
    }


    function disLikeVideo(button, videoId){
        $.post("ajax/disLikeVideo.php",{videoId:videoId})
         .done(function(data){
            
            let disLikeButton = $(button);
            let likeButton = $(button).siblings(".likeButton");
    
            disLikeButton.addClass("active");
            likeButton.removeClass("active");
            
            let result = JSON.parse(data);
             console.log(result);
            
            updateLikeValue(likeButton.find(".text"), result.likes)
            updateLikeValue(disLikeButton.find(".text"), result.disLikes)
            
            if(result.disLikes < 0){
                disLikeButton.removeClass("active");
                disLikeButton.find("img:first").attr("src","assets/images/icons/thumb-down.png");
            }else{
                disLikeButton.find("img:first").attr("src","assets/images/icons/thumb-down-active.png");
            }
            likeButton.find("img:first").attr("src","assets/images/icons/thumb-up.png");
    
         });
        }
    


    
    function updateLikeValue(element, num){
        let likesCountVal = element.text() || 0;
        element.text(parseInt(likesCountVal) + parseInt(num));
    }