<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('ab74faad5a566f4cdff5', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('skilledtalk');

    channel.bind('sendRequest', function(data) {
        if(data.notification.id != "{{auth()->user()->id}}"){
          toastr["info"](data.notification.name + " Send you friend request");
        }
    });


    // channel.bind('requestAccepted', function(data) {
    //     toastr["info"](data.data.name + " Accepted your friend request");
    // });

    channel.bind('{{ auth()->id() }}', function(data) {
       if(data.data.action === 'FRIEND_REQUEST_ACCPETED'){
        toastr["info"](data.data.name + " Accepted your friend request");
       }else if(data.data.action === 'RATE'){
        toastr["info"](data.data.text);
       }else if(data.data.action === 'REFLECT'){
         toastr["info"](data.data.text);
       } else if(data.data.action === 'JOB_APPLY'){
         toastr["info"](data.data.text);
       }else if(data.data.action === 'MESSAGE'){
          toastr["info"](data.data.text);
       } else if(data.data.action == 'NEW_ENGAGEMENT'){
         if('{{auth()->user()->id}}' == data.data.consult_with){
           toastr["info"](data.data.name + " " + data.data.message );
         }
       }else if(data.data.action == "ENGAGEMENT_ACCEPTANCE"){
         if('{{auth()->user()->id}}' == data.data.send_notification_to){
           toastr["info"](data.data.name + " " + data.data.message );
         }
       }
    });

  </script>
