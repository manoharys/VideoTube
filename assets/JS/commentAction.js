function postComment(button, postedBy, videoId, replyTo, containerClass) {
    let textarea = $(button).siblings("textarea");
    let commentText = textarea.val();
    //Emptying textarea once btn is clicked
    textarea.val("");

    if (commentText) {
        $.post("ajax/postComment.php", {
                commentText: commentText,
                postedBy: postedBy,
                videoId: videoId,
                responseTo: replyTo
            })
            .done(function (comment) {
                if(!replyTo) {
                    $("." + containerClass).prepend(comment);
                }
                else {
                    $(button).parent().siblings("." + containerClass).append(comment);
                }
            });
    } else {
        alert("You can't post an empty comment");
    }
}


function toggleReply(button) {
    let parent = $(button).closest(".itemContainer");
    let commentForm = parent.find(".commentForm").first();

    commentForm.toggleClass("hidden");
}

function likeComment(commentId, button, videoId){
       $.post("ajax/likeComment.php",{ commentId: commentId ,videoId:videoId})
       .done(function(numToChange){
       
       let likeButton = $(button);
       let disLikeButton = $(button).siblings(".disLikeButton");

       likeButton.addClass("active");
       disLikeButton.removeClass("active");
       
       let likesCount = $(button).siblings(".likesCount");
   
         updateLikeValue(likesCount, numToChange);
       
       if(numToChange < 0){
           likeButton.removeClass("active");
           likeButton.find("img:first").attr("src","assets/images/icons/thumb-up.png");
       }else{
           likeButton.find("img:first").attr("src","assets/images/icons/thumb-up-active.png");
       }
           disLikeButton.find("img:first").attr("src","assets/images/icons/thumb-down.png");

    });
}

function disLikeComment(commentId, button, videoId){
    $.post("ajax/disLikeComment.php",{ commentId: commentId ,videoId:videoId})
    .done(function(numToChange){
    
    let disLikeButton = $(button);
    let likeButton = $(button).siblings(".likeButton");

    disLikeButton.addClass("active");
    likeButton.removeClass("active");
    
    let likesCount = $(button).siblings(".likesCount");

      updateLikeValue(likesCount, numToChange);
    
    if(numToChange > 0){
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

function getReplies(commentId, button, videoId) {
    $.post("ajax/getCommentReplies.php", { commentId: commentId, videoId: videoId })
    .done(function(comments) {
        var replies = $("<div>").addClass("repliesSection");
        replies.append(comments);

        $(button).replaceWith(replies);
    });
}