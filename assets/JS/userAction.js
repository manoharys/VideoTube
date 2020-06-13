function subscribe(userTo, userFrom, button) {

    if (userTo == userFrom) {
        alert("you cannot subscribe it yourself");
    } else {
        $.post("ajax/subscribe.php",{userTo:userTo, userFrom:userFrom})
            .done(function (count) {
                //console.log(data);
               if(count != null){
                  $(button).toggleClass("subscribe unsubscribe");
                  let buttonText = $(button).hasClass('subscribe') ? "SUBSCRIBE" : "UNSUBSCRIBE";
                  $(button).text(buttonText + " " + count);   

               }
               else{
                   alert("something went wrong!");
               }
            
            })
    }
}